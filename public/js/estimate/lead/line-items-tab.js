var level1 = null;
$(document).ready(function () {
    const TREE_ITEM_TYPE_CODE = 1;
    const TREE_ITEM_TYPE_FOLDER = 2;
    Vue.component('lead-line-items-node-parent', {
        name: 'lead-line-items-node-parent',
        template: '#lead-line-items-node-parent-template',
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
                    summary: 0
                }

                const csiCodes = [];
                this.collectCsiCodes(this.tree, csiCodes);

                csiCodes.forEach(code => {
                    Object.keys(total).forEach((totalField) => {
                        const data = parseFloat(code.data[totalField]);
                        total[totalField] += totalField == 'quantity' ? data : data * code.data.quantity;
                    })
                });

                this.total = total;
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
            }
        },
        mounted() {
            this.load();
        }
    });

    Vue.component('lead-line-items-node', {
        name: 'lead-line-items-node',
        template: '#lead-line-items-node-template',
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
                if(this.node.type == 2) {
                    switch (this.level) {
                        case 0:
                            return '110px'
                        case 1:
                            return '220px';
                        case 2:
                            return '330px';
                        case 3:
                            return '440px';
                        default:
                            return '0px';
                    }
                }
                return '440px';
            }
        },
        methods: {
            getValue(name) {
                return this.node.data[name] * this.node.data.quantity;
            }
        },
        watch:{
            tree(){
                this.calculateTotal();
            }
        }

    });
});