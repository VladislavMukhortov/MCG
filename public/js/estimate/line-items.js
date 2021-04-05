var level1 = null;
$(document).ready(function () {
    const TREE_ITEM_TYPE_CODE = 1;
    const TREE_ITEM_TYPE_FOLDER = 2;

    Vue.component('estimate-template', {
        name: 'estimate-template',
        template: '#estimate-template-template',
        props:['template'],
        data() {
            return {
                folderName: '',

                //dynamic data
                tree: {},
                csil1: level1,
                csil2: {},
                csil3: {},
                csil4: {},
                total: {},

                // static data
                csicodes: {},
                allCategories: [],
                selected: [],

                TREE_ITEM_TYPE_CODE,
                TREE_ITEM_TYPE_FOLDER
            }
        },
        mounted() {
            this.load();
        },
        updated() {
            const _this = this;

            $('.table__item_container.droppable').droppable({
                greedy: true,
                hoverClass: 'drop-hover',
                drop: function (event, ui) {
                    const el = $(ui.draggable);
                    const index = el.attr('index');

                    const targetIndex = $(event.target).data('index');

                    _this.addCSICodeToFolder(_this.tree, targetIndex, _this.csicodes[index])
                }
            });
        },
        methods: {
            addCSICodeToFolder(tree, folderIndex, csiCode) {
                const _this = this;

                const csiCodeTreeItem = this.createTreeItem(
                    csiCode.id,
                    csiCode.item_name,
                    TREE_ITEM_TYPE_CODE,
                    {},
                    {
                        ...csiCode,
                        quantity: 1
                    }
                );

                Object.keys(tree).forEach(index => {
                    if (index == folderIndex) {
                        tree[index].children[csiCode.id] = csiCodeTreeItem;
                        return;
                    }

                    if (
                        tree[index].type == _this.TREE_ITEM_TYPE_FOLDER &&
                        index != folderIndex &&
                        !_.isEmpty(tree[index].children)
                    ) {
                        _this.addCSICodeToFolder(tree[index].children, folderIndex, csiCode);
                    }
                });

                this.updateTree(tree);
            },
            addItemToTree(item, type) {
                switch (type) {
                    case this.TREE_ITEM_TYPE_CODE:
                        this.addCsiCodeToTree(item)
                        break
                    case this.TREE_ITEM_TYPE_FOLDER:
                        this.addCustomFolderToTree(item);
                        break
                }

                this.calculateTotal();
            },
            addCustomFolderToTree(folderName) {
                const folder = this.createTreeItem(
                    Math.random().toString().substring(7),
                    folderName,
                    TREE_ITEM_TYPE_FOLDER,
                    {},
                    {
                        custom: true
                    }
                );
                if (folder) {
                    this.updateTree(_.merge({
                        [folder.id]: folder
                    }, this.tree))
                }

            },
            addCsiCodeToTree(csiCode) {

                const csiCodeTreeItem = this.createTreeItem(
                    csiCode.id,
                    csiCode.item_name,
                    TREE_ITEM_TYPE_CODE,
                    {},
                    {
                        ...csiCode,
                        quantity: 1
                    }
                );

                const folders = csiCode.categories.map((item, index) => {
                    const categoryData = this.allCategories[++index].find(category => category.id == item);

                    return this.createTreeItem(
                        categoryData.id,
                        categoryData.code + ' ' + categoryData.description,
                        TREE_ITEM_TYPE_FOLDER,
                        index == csiCode.categories.length ? {[csiCode.id]: csiCodeTreeItem} : {},
                        {id: categoryData.id, level_id: categoryData.level_id}
                        
                    );
                });

                let folder = this.nestTreeElements(folders);
                if (folder) {
                    this.updateTree(_.merge(this.tree, {
                        [folder.id]: folder
                    }))
                }

            },
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
                    if (tree[index].id == id && tree[index].type == type) {
                        delete tree[index];
                        return;
                    }

                    if (
                        tree[index].type == TREE_ITEM_TYPE_FOLDER &&
                        index !== id &&
                        !_.isEmpty(tree[index].children)
                    ) {
                        _this.removeFromTree(tree[index].children, id, type);
                    }
                });

                this.updateTree(tree);

                this.calculateTotal();
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
            addNewFolder() {
                const {folderName} = this;
                if (folderName != null) {
                    this.addItemToTree(folderName, TREE_ITEM_TYPE_FOLDER);
                }
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
            droppable() {
                const _this = this;
                $('.droppable').droppable({
                    hoverClass: 'drop-hover',
                    drop: function (event, ui) {
                        const el = $(ui.draggable);
                        const index = el.attr('index');
                        const csiCode = _this.csicodes[index];

                        _this.addItemToTree(csiCode, TREE_ITEM_TYPE_CODE);
                    }
                });
            },
            draggable() {
                $('.all_codes li.draggable').draggable({
                    revert: true,
                    scroll: false,
                    cursor: 'move',
                    containment: '.modal',
                    helper: 'clone'
                });
            },
            submitTable(id) {
                const _this = this;
                $.ajax({
                    url: 'estimates/save-line-items/' + id,
                    method: 'post',
                    data: {tree: _this.tree, total: _this.total},
                    success: function (data) {
                        window.location.reload();
                    }
                });
            },
            selectNextLevel(index, item, level) {
                this.selected['csil' + level] = item;
                this[`csil${++level}`] = item.children[level];
                this.csicodes = item.csi_codes;

                delete this.selected[`csil${level++}`];
                delete this.selected[`csil${level}`];

                this.$nextTick(() => {
                    this.draggable();
                });
            },
            load() {
                const _this = this;
                $.ajax({
                    url: 'estimates/get-csi-codes/'+_this.template,
                    method: 'get',
                    success: function (data) {
                        _this.csicodes = data.csicodes;
                        _this.csil1 = data.categories[1];
                        _this.allCategories = data.categories;
                        _this.tree=!_.isEmpty(data.lineItems)?data.lineItems:{};
                        window.app = data.csil1;
                        
                        _this.$nextTick(() => {
                            _this.droppable();
                            _this.draggable();
                            _this.updateTree(_this.tree);
                           
                        });

                    }
                });
            },
        }
    });

    Vue.component('node', {
        name: 'node',
        template: '#node-template',
        props: {
            tree: Object,
            node: Object,
            level: Number,
            removeFromTree: Function,
            calculateTotal: Function,
        },
        computed: {
            padding() {
                return (this.level * 20) + 'px';
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

    var app = new Vue({
        el: '.nk-app-root',
    })
});