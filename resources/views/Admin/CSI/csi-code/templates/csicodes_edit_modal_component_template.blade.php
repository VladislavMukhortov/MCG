<script type="text/x-template" id="edit-csi-code-modal-template">
    <div>
        <a href="javascript:void(0);"
           data-toggle="modal"
           :data-code_id="csiCode.id"
           :data-target="'#editCsiCode'+csiCode.id"
           class="edit_existing_csi_code"
           @click="open()"
        >
            <em class="icon ni ni-edit-fill fs-17px"></em>
        </a>
        <edit-csi-code-form
                v-if="openForm"
                :route="route"
                :csi-code="csiCode"
                :csi-code-id="csiCode.id"
{{--                :all-categories="allCategories"--}}
                :selected-categories="defaultCategories"
                :csi-categories-route="csiCategoriesRoute"
                :categories-route="categoriesRoute"
                :key="csiCode.id"
                @formClosed="closeForm"
        ></edit-csi-code-form>
    </div>
</script>