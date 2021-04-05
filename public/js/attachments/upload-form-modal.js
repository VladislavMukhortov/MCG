$(document).ready(function () {
    const $doc = $(document);
    $doc.on('click', '.upload-attachment', function (e) {
        $("#newAttachment").modal('show');

    });

    Vue.component('upload-form', {
        name: 'upload-form',
        template: '#upload-form-template',
        props: {
            route: { type: String, required: true },
            estimateId:  Number,
            requestId:  Number,
            projectId:  Number,
            leadId: Number,
            userId: Number,
            project: Number,
            request: Number,
            lineItem: Number,
            withType: Boolean
        },
        data () {
            return {
                csrf: document.querySelector('input[name="_token"]').getAttribute('value'),
                attachmentDescription: '',
                validationErrors: '',
                estimateAttachmentType: '',
                fileName: '',
                file: '',
            }
        },
        computed: {

        },
        methods: {
            submitFrom() {
                var vm          = this;
                var formData    = new FormData();
                formData.append('description', vm.attachmentDescription);
                formData.append('user_id', vm.userId);
                if (vm.estimateAttachmentType && vm.estimateId) {
                    formData.append('estimate_attachment_type', vm.estimateAttachmentType);
                }
                if (vm.estimateId) {
                    formData.append('estimate_id', vm.estimateId);
                }
                if (vm.requestId) {
                    formData.append('request_id', vm.requestId);
                }
                if (vm.projectId) {
                    formData.append('project_id', vm.projectId);
                }
                if (vm.leadId) {
                    formData.append('lead_id', vm.leadId);
                }
                if (vm.withType) {
                    formData.append('estimate_attachment_type', vm.estimateAttachmentType)
                }
                if (vm.file) {
                    formData.append('file', vm.file, vm.fileName);
                }
                //todo other fields
                axios({
                    method: "POST",
                    url: vm.route,
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': vm.csrf
                    }
                })
                    .then(response => {
                        this.onSuccess(response.data);
                        //
                        // resolve(response.data);
                    })
                    .catch(error => {
                        this.onFail(error);
                        //
                        // reject(error);
                    });
            },
            setAttachmentType(event) {
                this.estimateAttachmentType = event.target.value;
            },
            setAttachmentDescription(event) {
                this.attachmentDescription = event.target.value;
            },
            setEstimateAttachmentType(event) {
                this.estimateAttachmentType = event.target.value;
            },
            onUpload(data) {
                this.file = data.file;
                this.fileName = data.fileName;
            },
            onSuccess() {
                window.location.reload();
            },
            onFail(error) {
                this.validationErrors = error.response.data.errors;
                // this.errors.record(errors);
            }
        },
        mounted() {
        }

    });

    Vue.component('file-upload', {
        name: 'file-upload',
        template: '#file-upload-template',
        props: {
            label: {
                type: String,
                default: 'Choose or Drop file to Upload'
            },
            accept: {
                type: String,
                default: '*' // image/png, image/jpeg, application/pdf, application/vnd.ms-excel
            }
        },
        data () {
            return {
                file: null,
                name: null,
                progress: 0,
                error: null,
                dragAndDropCapable: true,
                maxFileSize: 20000000, //20 MB
            }
        },
        methods: {
            isDragAndDropCapable () {
                const { div } = this.$refs
                return (('draggable' in div)
                    || ('ondragstart' in div && 'ondrop' in div))
                    && 'FormData' in window
                    && 'FileReader' in window
            },
            onFileChange(e) {
                const files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return
                if (files[0].size > this.maxFileSize) {
                    window.alert('File size must be less then 20MB');
                    return
                }
                this.createFile(files[0])
            },
            upload() {
                this.$emit('upload', {
                    file: this.file,
                    fileName: this.name
                })
            },
            createFile(file) {
                const reader = new FileReader()
                const vm = this
                reader.onprogress = e => {
                    if (e.lengthComputable) {
                        vm.trackProgress(e.loaded, e.total)
                    }
                }
                reader.onloadend = e => {
                    const { error } = e.target
                    if (error != null) {
                        switch (error.code) {
                            case error.ENCODING_ERR:
                                vm.error = 'Encoding error!'
                                break
                            case error.NOT_FOUND_ERR:
                                vm.error = 'File not found!'
                                break
                            case error.NOT_READABLE_ERR:
                                vm.error = 'File could not be read!'
                                break
                            case error.SECURITY_ERR:
                                vm.error = 'Security issue with file!'
                                break
                            default:
                                vm.error = 'I have no idea what\'s wrong!'
                        }
                    }
                    vm.trackProgress(e.loaded, e.total)
                }
                reader.onload = e => {
                    const { result } = e.target
                    // vm.file = result
                    vm.file = file
                    // this.$emit('load', result)
                    vm.name = file.name
                    vm.upload()
                }
                reader.readAsBinaryString(file)
            },
            trackProgress (loaded, total) {
                this.progress = parseInt(((loaded / total) * 100), 10)
            },
            removeFile () {
                this.progress = 0
                this.file = ''
                this.name = null
                this.upload()
                // this.$emit('load', null)
            }
        },
        mounted() {
            const {div} = this.$refs
            // Determine if drag and drop functionality is capable in the browser
            this.dragAndDropCapable = this.isDragAndDropCapable()
            if (this.dragAndDropCapable) {
                ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(event => {
                    document.body.addEventListener(event, e => {
                        e.preventDefault()
                        e.stopPropagation()
                        // if (e.type === 'dragover') {
                        //   console.log('dragover', div) // eslint-disable-line
                        //   div.classList.add('dragover')
                        // }
                    })
                })
                div.addEventListener('drop', e => {
                    this.onFileChange(e)
                })
            }
        }
    });
});