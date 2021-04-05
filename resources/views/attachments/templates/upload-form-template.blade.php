
<script type="text/x-template" id="upload-form-template">

    <div class="modal fade" tabindex="-1" id="newAttachment">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Attachment</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post" class="form-validate"
                          enctype="multipart/form-data">
                        <input type="hidden" name="uploaded_by" :value="userId">
                        <input v-if="estimateId" type="hidden" name="estimate" :value="estimateId">
                        <input v-if="requestId" type="hidden" name="request" :value="requestId">
                        <input v-if="projectId" type="hidden" name="request" :value="projectId">
                        <div class="row g-4">

                            <div v-if="withType" class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Attachment Type<span style="color: red"> *</span></label>
                                    <div class="form-control-wrap">
                                        <select class="form-control " name="estimate_attachment_type"
                                                data-placeholder="Select a option" required @change="setEstimateAttachmentType($event)">
                                            <option label="empty" value=""></option>
                                            <option value="1">Existing Condition Image</option>
                                            <option value="2">Concept Image</option>
                                            <option value="3">Floor Plan</option>
                                            <option value="4">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="cf-default-textarea" for="cf-default-textarea">Attachment Description</label>
                                    <div class="form-control-wrap">
                                    <textarea class="form-control form-control-sm" id="cf-default-textarea"
                                              name="description" @change="setAttachmentDescription($event)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-06">File</label>
                                    <div class="form-control-wrap" >
                                        <file-upload @upload="onUpload"></file-upload>
                                    </div>
                                </div>
                                <pre>max file size is 20MB</pre>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary" @click="submitFrom">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                </div>

            </div>
        </div>
    </div>

</script>

<script type="text/x-template" id="file-upload-template">
    <div ref="div" class="upload-droppable-area" style="border: 1px dashed #6c7a8c !important;">
        <label>
            <strong v-if="progress === 0">
                <h5>
                    Drop Files to upload
                    <br/>or
                    <br/>Select Files
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </h5>
            </strong>
            <strong v-if="progress > 0 && progress < 100"> @{{ progress }}%</strong>
            <span v-else class="right">@{{ name }}</span>
            <input ref="input"
                   type="file"
                   name="file"
{{--                   @input="uploadFile($event.target.value)"--}}
                   :accept="accept"
                   @change="onFileChange"/>
        </label>
        <svg v-if="progress === 100" @click="removeFile" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" style="display: inline!important">
            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
            <path d="M0 0h24v24H0z" fill="none"></path>
        </svg>
        <pre>@{{ error }}</pre>
    </div>
</script>
<style scoped>
    input[type="file"] {
        display: none;
    }
    strong,
    svg {
        vertical-align: middle;
    }
</style>
