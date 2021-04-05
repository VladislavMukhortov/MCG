<script type="text/x-template" id="edit-csi-code-form-template">
    <div class="modal fade zoom show" tabindex="-1" :id="'editCsiCode'+csiCodeId" aria-modal="true">
        <div class="modal-dialog modal-lg" role="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit CSI Code</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close" @click="close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
        <div class="modal-body edit-csi-model-body">
            <form action="javascript:void(0)" method="post" class="form-validate">
                <div class="row g-4">
                    <edit-sci-code-form-select
{{--                        v-if="!_.isEmpty(categoriesl1)"--}}
                        :categories="categoriesl1"
                        :level-id="1"
                        :selected-category-id="getSelectedCategoryId(0)"
                        @categoryWasSelected="categoryWasSelected"
                    ></edit-sci-code-form-select>
                    <edit-sci-code-form-select
{{--                            v-if="!_.isEmpty(categoriesl2)"--}}
                            :categories="categoriesl2"
                            :level-id="2"
                            :selected-category-id="getSelectedCategoryId(1)"
                            @categoryWasSelected="categoryWasSelected"
                    ></edit-sci-code-form-select>
                    <edit-sci-code-form-select
{{--                            v-if="!_.isEmpty(categoriesl3)"--}}
                            :categories="categoriesl3"
                            :level-id="3"
                            :selected-category-id="getSelectedCategoryId(2)"
                            @categoryWasSelected="categoryWasSelected"
                    ></edit-sci-code-form-select>
                    <edit-sci-code-form-select
{{--                            v-if="!_.isEmpty(categoriesl4)"--}}
                            :categories="categoriesl4"
                            :level-id="4"
                            :selected-category-id="getSelectedCategoryId(3)"
                            @categoryWasSelected="categoryWasSelected"
                    ></edit-sci-code-form-select>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Item Name <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="text"
                                       class="from-control-lg form-control"
                                       name="item_name"
                                       :value="item_name"
                                       @change="setItemName($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Building Materials <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="from-control-lg form-control"
                                       name="building_material"
                                       :value="building_material"
                                       @change="setBuildingMaterial($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Decoration Materials <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="number" min="0"
                                       class="from-control-lg form-control"
                                       name="decoration_material"
                                       :value="decoration_material"
                                       @change="setDecorationMaterial($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Labor <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="from-control-lg form-control"
                                       name="labor"
                                       :value="labor"
                                       @change="setLabor($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Subcontractors <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="from-control-lg form-control" name="subcontractors"
                                       :value="subcontractors"
                                       @change="setSubcontractors($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Manufacturing <span style="color: red"> *</span></label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="from-control-lg form-control" name="manufacturing"
                                       :value="manufacturing"
                                       @change="setManufacturing($event)"
                                       required/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        </div>
        <div class="modal-footer text-right">
            <button type="button" class="update_csi_codes btn btn-primary" @click="save()">Submit</button>
            <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        </div>
            </div>
        </div>
    </div>
</script>
