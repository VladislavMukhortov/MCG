//todo refactor legacy && not usable code && fix saving with folders in all places with same code
var level1 = null;
$(document).ready(function () {
    const TREE_ITEM_TYPE_CODE = 1;
    const TREE_ITEM_TYPE_FOLDER = 2;
    Vue.component('line-items-node-parent', {
        name: 'line-items-node-parent',
        template: '#line-items-node-parent-template',
        props: {
            estimateId: Number,
            lineItemId: Number
        },
        data() {
            return {
                tree: {},
                total: {},
            }
        },
        methods: {
            updateTree(newTree) {
                // destroy vue observer due to inability of vue to watch deeply nested object changes
                this.tree = JSON.parse(JSON.stringify(newTree));
            },
            nestTreeElements(treeItems) {
                for (let i = treeItems.length - 1; i > 0; i--) {
                    treeItems[i - 1].children[treeItems[i].id] = treeItems[i];
                }

                return treeItems.shift();
            },
            removeFromTree(tree, id, type) {
                const _this = this;
                Object.keys(tree).forEach(index => {

                    if (tree[index].id == id && tree[index].type == 1) {
                        delete tree[index];
                        return;
                    }

                    if (tree[index].type == TREE_ITEM_TYPE_FOLDER) {
                        if ( !_.isEmpty(tree[index].children) ) {
                            _this.removeChildNodeFromTree(tree[index].children, id, type);
                        } else {
                            delete tree[index];
                        }
                    }
                });
                _this.removeEmptyCategories(tree)
                this.updateTree(tree);
                this.calculateTotal();
                this.submitTree();
                //reload page for updating data in "EDit Line Items" modal =/ todo refactor
                window.location.reload();
                // setTimeout(() => {
                // }, 3000)
            },
            removeChildNodeFromTree(node, id, type) {
                const _this = this;
                Object.keys(node).forEach(index => {

                    if (node[index].id == id && node[index].type == 1) {
                        delete node[index];
                        return;
                    }

                    if (node[index].type == TREE_ITEM_TYPE_FOLDER) {
                        if ( !_.isEmpty(node[index].children) ) {
                            _this.removeChildNodeFromTree(node[index].children, id, type);
                        } else {
                            delete node[index];
                            return;
                        }
                    }
                });
            },
            removeEmptyCategories(tree) {
                const _this = this;
                Object.keys(tree).forEach(index => {

                    if (tree[index].type == TREE_ITEM_TYPE_FOLDER) {
                        if (_.isEmpty(tree[index].children) ) {
                            delete tree[index];
                            _this.removeEmptyCategories(_this.tree);
                        } else {
                            console.log(tree[index])
                            _this.removeEmptyCategories(tree[index].children)
                        }
                    }
                });
            },
            createTreeItem(id, name, type, children, data) {
                return {
                    id,
                    name: name || '',
                    type: type || TREE_ITEM_TYPE_FOLDER,
                    children: children || {},
                    data: data || {}

                };
            },
            collectCsiCodes(tree, csiCodes) {
                const _this = this;

                Object.keys(tree).forEach(index => {
                    if (tree[index].type == TREE_ITEM_TYPE_CODE) {
                        csiCodes.push(tree[index]);
                    }

                    if (
                        tree[index].type == TREE_ITEM_TYPE_FOLDER &&
                        !_.isEmpty(tree[index].children)
                    ) {
                        _this.collectCsiCodes(tree[index].children, csiCodes);
                    }
                });
            },
            calculateTotal() {
                const total = {
                    quantity: 0,
                    building_material: 0,
                    decoration_material: 0,
                    subcontractors: 0,
                    labor: 0,
                    summary: 0
                }

                const csiCodes = [];
                this.collectCsiCodes(this.tree, csiCodes);

                csiCodes.forEach(code => {
                    Object.keys(total).forEach((totalField) => {
                        const data = parseFloat(code.data[totalField]);
                        total[totalField] += totalField == 'quantity' ? data : (data * code.data.quantity);
                    })
                });

                total.building_material = total.building_material.toFixed(1);
                total.decoration_material = total.decoration_material.toFixed(1);
                total.subcontractors = total.subcontractors.toFixed(1);
                total.labor = total.labor.toFixed(1);
                total.summary = total.summary.toFixed(1);

                this.total = total;
            },
            submitTree() {
                const _this = this;
                $.ajax({
                    url: 'estimates/save-line-items/'+_this.estimateId,
                    data: {
                        "_token": window.csrfToken,
                        "tree": _this.tree,
                        "total": _this.total,
                        // todo folder
                    },
                    method: 'post',
                    success: function (data) {
                        _this.makeChanges(data, _this)
                    }
                });
            },
            load() {
                const _this = this;
                $.ajax({
                    url: 'estimates/'+_this.estimateId+'/line-items',
                    method: 'get',
                    success: function (data) {
                        _this.makeChanges(data, _this)
                    }
                });
            },
            makeChanges(data, _this) {
                _this.tree = !_.isEmpty(data.lineItems) ? data.lineItems:{};

                _this.$nextTick(() => {
                    _this.updateTree(_this.tree);
                });
            },
        },
        mounted() {
            this.load();
        }
    });

    Vue.component('line-items-node', {
        name: 'line-items-node',
        template: '#line-items-node-template',
        props: {
            tree: Object,
            node: Object,
            level: Number,
            removeFromTree: Function,
            calculateTotal: Function,
            submitTree: Function,
        },
        computed: {
            padding() {
                return (this.level * 20) + 'px';
            }
        },
        methods: {
            getValue(name) {
                return (this.node.data[name] * this.node.data.quantity);
            }
        },
        watch:{
            tree(){
                this.calculateTotal();
            }
        }

    });
});