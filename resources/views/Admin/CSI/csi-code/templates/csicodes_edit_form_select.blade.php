<script type="text/x-template" id="edit-sci-code-form-select-template">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-label">CSI Code L@{{ currentLevel }}
                <span style="color: red"> *</span>
            </label>
            <div class="form-control-wrap">
                <select class="form-select form-control"
                        name="categories[]"
                        @change="selectCategory($event)"
{{--                        :class="'edit__select__category__modal'"--}}
                        required>

                    <option selected disabled>Type to search</option>
                    <option v-for="(category, index) in categories"
                            :value="category.id"
                            @select="selectCategory($event)"
                            :selected="isSelectedCategory(category)"
                    >@{{ category ? category.full_name : 'Please Select' }}!
                    </option>
                </select>
            </div>
        </div>
    </div>
</script>