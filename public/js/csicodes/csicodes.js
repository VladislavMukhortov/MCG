$(document).ready(function(){
    const $doc=$(document);


    $doc.on('click', '.edit_existing_csi_code', function (e) {
        e.preventDefault();
        $("#editCsiCode"+$(this).data('code_id')).modal('show');
    })
    $doc.on('click', '.add_new_csi_code', function(e){
        e.preventDefault();
        const href=$(this).attr('href');
        var _this=$(this);
        $.ajax({
            url: href,
            type:'get',
            beforeSend:function(){
                $(this).attr('disabled',true);
            },
            success:function(data){
                $(".csi-model-body").html(data);
                $("#modalCSICode").modal('show');
                _this.removeAttr('disabled');
            }
        });
    })
    $doc
    .on('click', '.save_csi_codes', function(e){
        e.preventDefault();
        var href=$(".csi-model-body form").attr('action');
        var fromData=$(".csi-model-body form").serialize();
        if(!$(".form-validate").valid()){
            return false;
        }
        $.ajax({
            url:href,
            method:'post',
            data:fromData,
            beforeSend:function(){
                $(this).attr('disabled',true);
                $(this).html('Saving...');
            },
            success:function(data){
                window.location.reload();
            },
            cache: false
        }).fail(function (jqXHR, textStatus, error) {
            if( jqXHR.status === 422 ) {

                $errors = jqXHR.responseJSON;

                errorsHtml = '<div class="alert alert-danger"><ul>';

                $.each( $errors.errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></di>';

                $( '#form-csi-code-errors' ).html( errorsHtml );
            } else {

            }
            // $('#modalCSICode').modal('show');
        });
    })
    Vue.component('edit-csi-code-modal', {
        name: 'edit-csi-code-modal',
        template: '#edit-csi-code-modal-template',
        props: {
            csiCategoriesRoute:  { type: String, required: true },
            categoriesRoute: { type: String, required: true },
            route: { type: String, required: true },
            selectedCategories: Array,
            csiCodeId: Number,
            csiCode: Object
        },
        data () {
            return {
                allCategories: [],
                openForm: false,
                defaultCategories: []
            }
        },
        methods: {
            open() {
                this.loadCsiCodeCategories();
                this.$emit('opened');
            },
            closeForm(e) {
                this.openForm = false;
            },
            loadCsiCodeCategories() {
                const vm = this;
                axios({
                    method: "GET",
                    url: vm.csiCategoriesRoute,
                    params: {
                        csi_code_id: vm.csiCodeId,
                    },
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': vm.csrf
                    }
                })
                    .then(response => {
                        vm.defaultCategories = response.data;
                        this.openForm = true;
                    })
                    .then(() => {

                    })
                    .catch(error => {
                        this.onFail(error);
                    });
            },
        }
    });
    Vue.component('edit-sci-code-form-select', {
        name: 'edit-sci-code-form-select',
        template: '#edit-sci-code-form-select-template',
        props: {
            levelId: Number,
            categories: Array,
            selectedCategoryId: Number,
        },
        data () {
            return {
                currentLevel: this.levelId
            }
        },
        methods: {
            selectCategory(event) {
                this.$emit('categoryWasSelected', {
                    lvl: this.levelId,
                    categoryId: event.target.value
                })
            },
            isSelectedCategory(category) {
                return category.id === this.selectedCategoryId
            }
        },
        mounted() {
        }
    });
    Vue.component('edit-csi-code-form', {
        name: 'edit-csi-code-form',
        template: '#edit-csi-code-form-template',
        props: {
            route: { type: String, required: true },
            categoriesRoute: { type: String, required: true },
            selectedCategories: Array,
            csiCategoriesRoute:  { type: String, required: true },
            csiCodeId: Number,
            csiCode: Object,
        },
        data () {
            return {
                csrf: document.querySelector('input[name="_token"]').getAttribute('value'),
                validationErrors: '',
                currentCategorySelectLevel: 1,
                allCategories: [],
                categoriesl1: [],
                categoriesl2: [],
                categoriesl3: [],
                categoriesl4: [],
                categoriesSelect: [],
                item_name: this.csiCode.item_name,
                building_material: this.csiCode.building_material,
                decoration_material: this.csiCode.decoration_material,
                labor: this.csiCode.labor,
                subcontractors: this.csiCode.subcontractors,
                manufacturing: this.csiCode.manufacturing,
            }
        },
        computed: {
            form() {
                return {
                    categories: this.categoriesSelect,
                    item_name: this.item_name,
                    building_material: this.building_material,
                    decoration_material: this.decoration_material,
                    labor: this.labor,
                    subcontractors: this.subcontractors,
                    manufacturing: this.manufacturing
                }
            },
            categories() {
                return this.allCategories;
            }
        },
        methods: {
            categoryWasSelected(e) {
                selectedLvl         = e.lvl;
                selectedCuttegoryId = e.categoryId;
                this.categoriesSelect[selectedLvl-1] = parseInt(selectedCuttegoryId);
                this.categoriesSelect = this.categoriesSelect.slice(0, selectedLvl);
                this.loadLeveledCategories(++selectedLvl, selectedCuttegoryId);
            },
            timeoutLoad(lvl, categoryId)
            {
                var vm = this;
                setTimeout( function () {
                    vm.loadLeveledCategories(lvl, categoryId)
                }, 3000);
            },
            loadLeveledCategories(lvl = 1, categoryId = null) {
                const vm = this;
                axios({
                    method: "GET",
                    url: vm.categoriesRoute,
                    params: {
                        level_id: lvl,
                        selectedCategoryId: categoryId
                    },
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': vm.csrf
                    }
                })
                    .then(response => {
                        if (lvl === 1) {
                            vm.currentCategorySelectLevel = lvl;
                            vm.categoriesl1 = response.data.data;
                            vm.categoriesl2 = [];
                            vm.categoriesl3 = [];
                            vm.categoriesl4 = [];
                        }
                        if (lvl === 2) {
                            vm.currentCategorySelectLevel = lvl;
                            vm.categoriesl2 = response.data.data;
                            vm.categoriesl3 = [];
                            vm.categoriesl4 = [];
                        }
                        if (lvl === 3) {
                            vm.currentCategorySelectLevel = lvl;
                            vm.categoriesl3 = response.data.data
                            vm.categoriesl4 = [];
                        }
                        if (lvl === 4) {
                            vm.currentCategorySelectLevel = lvl;
                            vm.categoriesl4 = response.data.data
                        }
                    })
                    .catch(error => {
                        this.onFail(error);
                    });
            },
            getSelectedCategoryId(index) {
                return this.categoriesSelect[index];
            },
            selectCategory(event, lvl) {
                this.categoriesSelect[--lvl] = parseInt(event.target.value);
            },
            setItemName(event) {
                this.item_name = event.target.value;
            },
            setBuildingMaterial(event) {
                this.building_material = event.target.value;
            },
            setDecorationMaterial(event) {
                this.decoration_material = event.target.value;
            },
            setLabor(event) {
                this.labor = event.target.value;
            },
            setSubcontractors(event) {
                this.subcontractors = event.target.value;
            },
            setManufacturing(event) {
                this.manufacturing = event.target.value;
            },
            isSelectedCategory(category, lvl) {
                return this.categoriesSelect[--lvl] === category.id
            },
            save() {
                const vm = this;
                axios({
                    method: "PUT",
                    url: vm.route,
                    data: this.form
                })
                    .then(() => {
                        this.reloadPage();

                    }).catch(error => {
                    this.onFail(error);
                })
            },
            onFail(error) {
                this.validationErrors = error.response.data.errors;
                // this.errors.record(errors);
            },
            close() {
                this.categoriesSelect = this.selectedCategories;
                this.$emit('formClosed');
            },
            reloadPage() {
                window.location.reload();
            },
            makeDefaultChanges() {

                var vm = this
                vm.loadLeveledCategories(1)
                if (vm.categoriesSelect.length) {
                    var len = Object.keys(vm.categoriesSelect).length
                    setTimeout(function () {
                        vm.categoriesSelect.forEach((element, index) => {
                            if (index !== len) {
                                let lvl = index + 1;
                                if (lvl === 2 || lvl === 3 ) {
                                    vm.timeoutLoad(++lvl, element)
                                } else {
                                    vm.loadLeveledCategories(++lvl, element)
                                }
                            }

                        })
                    }, 1000);
                }
            }
        },
        mounted() {

        },
        created()
        {
            this.categoriesSelect = this.selectedCategories
            this.makeDefaultChanges();
        }
    });
    var app = new Vue({
        el: '.nk-app-root',
    })

    //add names for lvls.
    $doc.on('click', '.just-new-one', function(e){
        $(".csi-code-modal-lvl").html("CSI Code");
    });
    $doc.on('click', '.new-1', function(e){
        $(".csi-code-modal-lvl").html("CSI L1 Code");
    });
    $doc.on('click', '.new-2', function(e){
        $(".csi-code-modal-lvl").html("CSI L2 Code");
    });
    $doc.on('click', '.new-3', function(e){
        $(".csi-code-modal-lvl").html("CSI L3 Code");
    });
    $doc.on('click', '.new-4', function(e){
        $(".csi-code-modal-lvl").html("CSI L4 Code");
    });
    $doc.on('click', '#selectCSICategoryLVL1', function(e) {
        if($(this).val()) {
            $("#selectCSICategoryLVL2").attr('disabled', false);
        } else {
            $("#selectCSICategoryLVL2").attr('disabled', true);
        }
    });
    $doc.on('click', '#selectCSICategoryLVL2', function(e) {
        if($(this).val()) {
            $("#selectCSICategoryLVL3").attr('disabled', false);
        } else {
            $("#selectCSICategoryLVL3").attr('disabled', true);
        }
    });
    $doc.on('click', '#selectCSICategoryLVL3', function(e) {
        if($(this).val()) {
            $("#selectCSICategoryLVL4").attr('disabled', false);
        } else {
            $("#selectCSICategoryLVL4").attr('disabled', true);
        }
    })
    $doc.on('click', '.edit__select__category__modal', function(e) {
        var lvl = $(this).attr('level')
        var codeId = $(this).attr('code')
        lvl = ++lvl;
        if($(this).val()) {
            $(".edit__select__category__modal[level="+lvl+"][code="+codeId+"]").attr('disabled', false);
        } else {
            $("#selectEditCSICategoryLVL2").attr('disabled', true);
        }
    });
});
