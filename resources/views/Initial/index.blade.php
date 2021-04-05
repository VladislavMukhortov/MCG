@extends('layouts.initialform')

{{-- Page Title --}}
@section('page-title')
    Requests

@endsection

{{-- Page CSS --}}
@section('page-css')

@endsection

{{-- Page Content --}}
@section('page-content')
    <form action="{{ route('initial-form.store') }}" id="form" method="POST" enctype="multipart/form-data">
        @csrf
        <main class="vv-main">
            <div class="vv-header">
                <img src="images/logo.png">
                <h2 class="subtitle is-4">Before to start the process, please fill following form below.</h2>
            </div>

            <div class="columns">
                <div>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 1" class="card card-bordered">
                            <div class="card-inner">
                                <div class="col-lg-12 mb-3 my-3">
                                    <validation-provider rules="required|min:2|max:30|alpha" immediate
                                                         v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Firstname</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="First namet" v-model="firstname" name="firstname">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>

                                    </validation-provider>
                                </div>

                                <div class="col-lg-12 mb-3 my-3">
                                    <validation-provider rules="required|min:2|max:30|alpha" immediate
                                                         v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Lastname</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Lastname" v-model="lastname" name="lastname">
                                                <p v-if="failed" class="invalid">@{{ errors[0] }}</p>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>

                                <validation-provider rules="required|email" immediate v-slot="{ errors, failed }">
                                    <div class="col-lg-12 mb-3 my-3">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="class_name" type="text"
                                                       placeholder="Email" v-model="email" name="email"
                                                       @keyup="check()">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                <span :class="[dynamic_class ? 'success' : 'invalid']">@{{ message }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </validation-provider>

                                <div class="col-lg-12 mb-3 my-3">
                                    <validation-provider rules="required" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" v-mask="'+1 (###) ###-##-##'"
                                                       :class="{ 'is-danger': failed }" type="text" placeholder="Phone"
                                                       v-model="phone" name="phone">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group" v-if="valid === true">
                                        <button class="btn btn-lg btn-primary" @click.prevent="next()">Next</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 2" class="card card-bordered">
                            <div class="card-inner">


                                <div class="field">
                                    <validation-provider rules="required|min:5|max:60" immediate
                                                         v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Street 1</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Street 1" v-model="street1" name="street1">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="min:5|max:60" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Street 2</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Street 2" v-model="street2" name="street2">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="required|min:5|max:45" immediate
                                                         v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="City" v-model="city" name="city">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="required|max:5" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="State" v-model="state" name="state">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="required" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">ZIP Code</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" v-mask="'#####-####'"
                                                       :class="{ 'invalid': failed }" type="text" placeholder="Zip"
                                                       v-model="zip" name="zip">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>

                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 3" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Byilding Type</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'invalid': failed }"
                                                        v-model="type" name="type">
                                                    <option value="1">Apartment building</option>
                                                    <option value="2">Single / Multi-family home</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="required" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Building Stage</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'invalid': failed }"
                                                        v-model="stage" name="stage">
                                                    <option value="1">I own the property</option>
                                                    <option value="2">I'm in contact with property</option>
                                                    <option value="3">Apartment building</option>
                                                    <option value="4">Single / Multi-family home</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="required" immediate v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'invalid': failed }"
                                                        v-model="startdate" name="startdate">
                                                    <option value="1">As soon as possible</option>
                                                    <option value="2">In 1 month</option>
                                                    <option value="3">In 2 months</option>
                                                    <option value="4">3-6 months</option>
                                                    <option value="5">Not sure</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>

                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 4" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required|max:5" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Floor Plan</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'invalid': failed }" type="text"
                                                        v-model="floorplan" name="floorplan">
                                                    <option value="1">Yes</option>
                                                    <option value="2">But I know approximate room measurements</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary"
                                                v-if="valid === true && floorplan === '1'" @click.prevent="next()">Next
                                        </button>
                                        <button class="btn btn-lg btn-primary"
                                                v-if="valid === true && floorplan === '2'"
                                                @click.prevent="nextNoFloorPlan()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 5" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400"
                                                         v-slot="{ errors, validate }">
                                        <div class="form-group">
                                            <label class="form-label">Floor File</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="floorplanfile" @change="validate">
                                                <span class="invalid">Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button v-if="valid === true" class="btn btn-lg btn-primary"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 6" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom1" name="stageroom1">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="6">Dining room</option>
                                                    <option value="7">Other</option>
                                                    <option value="8">Hallway / Corridor</option>
                                                    <option value="9">Office</option>
                                                    <option value="10">Den</option>
                                                    <option value="11">Nursery</option>
                                                    <option value="12">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" v-if="floorplan === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="floorplan === '2'"
                                                    @click.prevent="prevNoFloorPlan()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="valid === true && stageroom1 === '2' || valid === true && stageroom1 === '3' || valid === true && stageroom1 === '4' || valid === true && stageroom1 === '5' || valid === true && stageroom1 === '6' || valid === true && stageroom1 === '7' || valid === true && stageroom1 === '8' || valid === true && stageroom1 === '9' || valid === true && stageroom1 === '10' || valid === true && stageroom1 === '11' || valid === true && stageroom1 === '12'"
                                                    @click.prevent="nextNotBath()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="valid === true && stageroom1 === '1'" @click.prevent="next()">
                                                Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 7" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom1" name="statusbathroom1">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom1 === '1'"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom1 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 8" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                     name="bathroomcurrent1"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" id="ceiling1" type="radio"
                                                                v-model="bathroomcurrent1" name="bathroomcurrent1">
                                                        <p style="display: inline">Bathhub</p></div>
                                                    <div><input value="2" id="ceiling2" type="radio"
                                                                v-model="bathroomcurrent1" name="bathroomcurrent1">
                                                        <p style="display: inline">Walk-in Shower</p></div>
                                                    <div><input value="3" id="ceiling3" type="radio"
                                                                v-model="bathroomcurrent1" name="bathroomcurrent1">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" name="bathroomreplace1"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomreplace1"
                                                                name="bathroomreplace1">
                                                        <p style="display: inline">New Bathub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomreplace1"
                                                                name="bathroomreplace1">
                                                        <p style="display: inline">New Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomreplace1"
                                                                name="bathroomreplace1">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent1 !== null & bathroomreplace1 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 9" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Scope of Work</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                    <th>Required</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling1" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling1" name="ceiling1"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling1" name="ceiling1"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling1" name="ceiling1"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling1" name="ceiling1"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling1" name="ceiling1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls1"
                                                                   name="walls1"></td>
                                                        <td><input value="2" type="radio" v-model="walls1"
                                                                   name="walls1"></td>
                                                        <td><input value="3" type="radio" v-model="walls1"
                                                                   name="walls1"></td>
                                                        <td><input value="4" type="radio" v-model="walls1"
                                                                   name="walls1"></td>
                                                        <td><input value="5" type="radio" v-model="walls1"
                                                                   name="walls1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition1"
                                                                   name="wallpartition1"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition1"
                                                                   name="wallpartition1"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition1"
                                                                   name="wallpartition1"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition1"
                                                                   name="wallpartition1"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition1"
                                                                   name="wallpartition1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor1"
                                                                   name="floor1"></td>
                                                        <td><input value="2" type="radio" v-model="floor1"
                                                                   name="floor1"></td>
                                                        <td><input value="3" type="radio" v-model="floor1"
                                                                   name="floor1"></td>
                                                        <td><input value="4" type="radio" v-model="floor1"
                                                                   name="floor1"></td>
                                                        <td><input value="5" type="radio" v-model="floor1"
                                                                   name="floor1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard1"
                                                                   name="baseboard1"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard1"
                                                                   name="baseboard1"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard1"
                                                                   name="baseboard1"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard1"
                                                                   name="baseboard1"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard1"
                                                                   name="baseboard1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding1"
                                                                   name="crownmolding1"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding1"
                                                                   name="crownmolding1"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding1"
                                                                   name="crownmolding1"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding1"
                                                                   name="crownmolding1"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding1"
                                                                   name="crownmolding1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor1"
                                                                   name="interiordoor1"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor1"
                                                                   name="interiordoor1"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor1"
                                                                   name="interiordoor1"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor1"
                                                                   name="interiordoor1"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor1"
                                                                   name="interiordoor1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor1"
                                                                   name="closestdoor1"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor1"
                                                                   name="closestdoor1"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor1"
                                                                   name="closestdoor1"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor1"
                                                                   name="closestdoor1"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor1"
                                                                   name="closestdoor1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization1"
                                                                   name="closestorganization1"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization1"
                                                                   name="closestorganization1"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization1"
                                                                   name="closestorganization1"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization1"
                                                                   name="closestorganization1"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization1"
                                                                   name="closestorganization1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window1"
                                                                   name="window1"></td>
                                                        <td><input value="2" type="radio" v-model="window1"
                                                                   name="window1"></td>
                                                        <td><input value="3" type="radio" v-model="window1"
                                                                   name="window1"></td>
                                                        <td><input value="4" type="radio" v-model="window1"
                                                                   name="window1"></td>
                                                        <td><input value="5" type="radio" v-model="window1"
                                                                   name="window1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture1"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture1"
                                                                   name="lightfixture1"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture1"
                                                                   name="lightfixture1"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture1"
                                                                   name="lightfixture1"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture1"
                                                                   name="lightfixture1"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture1"
                                                                   name="lightfixture1"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>

                                            </table>
                                            <div v-if="stageroom1 === '1' || stageroom1 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight1"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" id="ceiling1" type="radio"
                                                                       v-model="recessedlight1" name="recessedlight1">
                                                            </td>
                                                            <td><input value="2" id="ceiling2" type="radio"
                                                                       v-model="recessedlight1" name="recessedlight1">
                                                            </td>
                                                            <td><input value="3" id="ceiling3" type="radio"
                                                                       v-model="recessedlight1" name="recessedlight1">
                                                            </td>
                                                            <td><input value="4" id="ceiling4" type="radio"
                                                                       v-model="recessedlight1" name="recessedlight1">
                                                            </td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture1"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture1"
                                                                       name="wallfixture1"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture1"
                                                                       name="wallfixture1"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture1"
                                                                       name="wallfixture1"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture1"
                                                                       name="wallfixture1"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture1"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture1"
                                                                       name="ceilingfixture1"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture1"
                                                                       name="ceilingfixture1"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture1"
                                                                       name="ceilingfixture1"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture1"
                                                                       name="ceilingfixture1"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling1 === null && walls1 === null && wallpartition1 === null && floor1 === null && baseboard1 === null && crownmolding1 === null && interiordoor1 === null && closestdoor1 === null && closestorganization1 === null && window1 === null && lightfixture1 === null && recessedlight1 === null && wallfixture1 === null && ceilingfixture1"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom1 === '2' || stageroom1 === '3' || stageroom1 === '4' || stageroom1 === '5' || stageroom1 === '6' || stageroom1 === '7' || stageroom1 === '8' || stageroom1 === '9' || stageroom1 === '10' || stageroom1 === '11' || stageroom1 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom1 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom1 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom1 === '1' || stageroom1 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling1 !== null && walls1 !== null && wallpartition1 !== null && floor1 !== null && baseboard1 !== null && crownmolding1 !== null && interiordoor1 !== null && closestdoor1 !== null && closestorganization1 !== null && window1 !== null && lightfixture1 !== null && recessedlight1 !== null && wallfixture1 !== null && ceilingfixture1 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom1 === '3' || stageroom1 === '4' || stageroom1 === '5' || stageroom1 === '6' || stageroom1 === '7' || stageroom1 === '8' || stageroom1 === '9' || stageroom1 === '10' || stageroom1 === '11' || stageroom1 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling1 !== null && walls1 !== null && wallpartition1 !== null && floor1 !== null && baseboard1 !== null && crownmolding1 !== null && interiordoor1 !== null && closestdoor1 !== null && closestorganization1 !== null && window1 !== null && lightfixture1 !== null"
                                                        @click.prevent="next()">Next</button></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 10" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #1 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize1" name="roomsize1">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #1 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo1" name="roominfo1">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 11" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #1 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition1" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #1 Inspiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration1" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #1 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal1"
                                                       name="roominspirationexternal1">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>
                            <div class="field">
                                <div class="form-group">
                                    <label class="form-label">Continue?</label>
                                    <div class="form-control-wrap">
                                        <span><p>Select new room</p><input value="1" type="radio" v-model="newroom2"
                                                                           name="newroom2"></span>
                                        <span><p>Finish</p><input value="2" type="radio" v-model="newroom2"
                                                                  name="newroom2"></span>
                                        <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom2 === '1'"
                                            @click.prevent="next()">Next
                                    </button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom2 === '2'"
                                            type="submit">Send form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>

                    <!-- // ROOM 1-->

                    <!-- ROOM 2 -->


                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 12" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom2" name="stageroom2">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="6">Dining room/option>
                                                    <option value="7">Other</option>
                                                    <option value="8">Hallway / Corridor</option>
                                                    <option value="9">Office</option>
                                                    <option value="10">Den</option>
                                                    <option value="11">Nursery</option>
                                                    <option value="12">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="col-12 mb-3 my-3">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary" @click.prevent="prev()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom2 === '2' || valid === true && stageroom2 === '3' || valid === true && stageroom2 === '4' || valid === true && stageroom2 === '5' || valid === true && stageroom2 === '6' || valid === true && stageroom2 === '7' || valid === true && stageroom2 === '8' || valid === true && stageroom2 === '9' || valid === true && stageroom2 === '10' || valid === true && stageroom2 === '11' || valid === true && stageroom2 === '12'"
                                                        @click.prevent="nextNotBath()">Next
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom2 === '1'"
                                                        @click.prevent="next()">Next
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 13" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom2" name="statusbathroom2">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom2 === ''"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom2 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 14" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                     name="bathroomcurrent2"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" id="ceiling1" type="radio"
                                                                v-model="bathroomcurrent2" name="bathroomcurrent2">
                                                        <p style="display: inline">Bathhub</p></div>
                                                    <div><input value="2" id="ceiling2" type="radio"
                                                                v-model="bathroomcurrent2" name="bathroomcurrent2">
                                                        <p style="display: inline">Walk-in Shower</p></div>
                                                    <div><input value="3" id="ceiling3" type="radio"
                                                                v-model="bathroomcurrent2" name="bathroomcurrent2">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" name="bathroomreplace2"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomreplace2"
                                                                name="bathroomreplace2">
                                                        <p style="display: inline">New Bathub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomreplace2"
                                                                name="bathroomreplace2">
                                                        <p style="display: inline">New Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomreplace2"
                                                                name="bathroomreplace2">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent2 !== null & bathroomreplace2 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 15" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling2" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling2" name="ceiling2"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling2" name="ceiling2"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling2" name="ceiling2"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling2" name="ceiling2"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling2" name="ceiling2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls2"
                                                                   name="walls2"></td>
                                                        <td><input value="2" type="radio" v-model="walls2"
                                                                   name="walls2"></td>
                                                        <td><input value="3" type="radio" v-model="walls2"
                                                                   name="walls2"></td>
                                                        <td><input value="4" type="radio" v-model="walls2"
                                                                   name="walls2"></td>
                                                        <td><input value="5" type="radio" v-model="walls2"
                                                                   name="walls2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition2"
                                                                   name="wallpartition2"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition2"
                                                                   name="wallpartition2"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition2"
                                                                   name="wallpartition2"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition2"
                                                                   name="wallpartition2"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition2"
                                                                   name="wallpartition2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor2"
                                                                   name="floor2"></td>
                                                        <td><input value="2" type="radio" v-model="floor2"
                                                                   name="floor2"></td>
                                                        <td><input value="3" type="radio" v-model="floor2"
                                                                   name="floor2"></td>
                                                        <td><input value="4" type="radio" v-model="floor2"
                                                                   name="floor2"></td>
                                                        <td><input value="5" type="radio" v-model="floor2"
                                                                   name="floor2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard2"
                                                                   name="baseboard2"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard2"
                                                                   name="baseboard2"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard2"
                                                                   name="baseboard2"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard2"
                                                                   name="baseboard2"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard2"
                                                                   name="baseboard2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding2"
                                                                   name="crownmolding2"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding2"
                                                                   name="crownmolding2"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding2"
                                                                   name="crownmolding2"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding2"
                                                                   name="crownmolding2"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding2"
                                                                   name="crownmolding2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor2"
                                                                   name="interiordoor2"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor2"
                                                                   name="interiordoor2"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor2"
                                                                   name="interiordoor2"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor2"
                                                                   name="interiordoor2"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor2"
                                                                   name="interiordoor2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor2"
                                                                   name="closestdoor2"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor2"
                                                                   name="closestdoor2"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor2"
                                                                   name="closestdoor2"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor2"
                                                                   name="closestdoor2"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor2"
                                                                   name="closestdoor2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization2"
                                                                   name="closestorganization2"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization2"
                                                                   name="closestorganization2"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization2"
                                                                   name="closestorganization2"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization2"
                                                                   name="closestorganization2"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization2"
                                                                   name="closestorganization2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window2"
                                                                   name="window2"></td>
                                                        <td><input value="2" type="radio" v-model="window2"
                                                                   name="window2"></td>
                                                        <td><input value="3" type="radio" v-model="window2"
                                                                   name="window2"></td>
                                                        <td><input value="4" type="radio" v-model="window2"
                                                                   name="window2"></td>
                                                        <td><input value="5" type="radio" v-model="window2"
                                                                   name="window2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture2"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture2"
                                                                   name="lightfixture2"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture2"
                                                                   name="lightfixture2"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture2"
                                                                   name="lightfixture2"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture2"
                                                                   name="lightfixture2"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture2"
                                                                   name="lightfixture2"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <span v-if="ceiling2 === null && walls2 === null && wallpartition2 === null && floor2 === null && baseboard2 === null && crownmolding2 === null && interiordoor2 === null && closestdoor2 === null && closestorganization2 === null && window2 === null && lightfixture2 === null"
                                                              class="invalid">Select each row</span>
                                                    </div>
                                                </div>
                                            </table>
                                            <div v-if="stageroom2 === '1' || stageroom2 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight2"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="recessedlight2"
                                                                       name="recessedlight2"></td>
                                                            <td><input value="2" type="radio" v-model="recessedlight2"
                                                                       name="recessedlight2"></td>
                                                            <td><input value="3" type="radio" v-model="recessedlight2"
                                                                       name="recessedlight2"></td>
                                                            <td><input value="4" type="radio" v-model="recessedlight2"
                                                                       name="recessedlight2"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture2"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture2"
                                                                       name="wallfixture2"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture2"
                                                                       name="wallfixture2"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture2"
                                                                       name="wallfixture2"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture2"
                                                                       name="wallfixture2"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture2"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture2"
                                                                       name="ceilingfixture2"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture2"
                                                                       name="ceilingfixture2"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture2"
                                                                       name="ceilingfixture2"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture2"
                                                                       name="ceilingfixture2"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling2 === null && walls2 === null && wallpartition2 === null && floor2 === null && baseboard2 === null && crownmolding2 === null && interiordoor2 === null && closestdoor2 === null && closestorganization2 === null && window2 === null && lightfixture2 === null && recessedlight2 === null && wallfixture2 === null && ceilingfixture2"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom2 === '2' || stageroom2 === '3' || stageroom2 === '4' || stageroom2 === '5' || stageroom2 === '6' || stageroom2 === '7' || stageroom2 === '8' || stageroom2 === '9' || stageroom2 === '10' || stageroom2 === '11' || stageroom2 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom2 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom2 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom2 === '1' || stageroom2 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling2 !== null && walls2 !== null && wallpartition2 !== null && floor2 !== null && baseboard2 !== null && crownmolding2 !== null && interiordoor2 !== null && closestdoor2 !== null && closestorganization2 !== null && window2 !== null && lightfixture2 !== null && recessedlight2 !== null && wallfixture2 !== null && ceilingfixture2 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom2 === '3' || stageroom2 === '4' || stageroom2=== '5' || stageroom2 === '6' || stageroom2 === '7' || stageroom2 === '8' || stageroom2 === '9' || stageroom2 === '10' || stageroom2 === '11' || stageroom2 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling2 !== null && walls2 !== null && wallpartition2 !== null && floor2 !== null && baseboard2 !== null && crownmolding2 !== null && interiordoor2 !== null && closestdoor2 !== null && closestorganization2 !== null && window2 !== null && lightfixture2 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 16" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #2 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize2" name="roomsize2">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #2 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo2" name="roominfo2">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 17" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #2 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition2" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #2 Insiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration2" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #2 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal2"
                                                       name="roominspirationexternal2">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>
                            <div class="field">
                                <div class="form-group">
                                    <label class="form-label">Continue?</label>
                                    <div class="form-control-wrap">
                                        <span><p>Select new room</p><input value="1" type="radio" v-model="newroom3"
                                                                           name="newroom3"></span>
                                        <span><p>Finish</p><input value="2" type="radio" v-model="newroom3"
                                                                  name="newroom3"></span>
                                        <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom3 === '1'"
                                            @click.prevent="next()">Next
                                    </button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom3 === '2'"
                                            type="submit">Send form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>


                    <!-- // ROOM 2-->
                    <!-- ROOM 3 -->


                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 18" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom3" name="stageroom3">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="4">Dining room/option>
                                                    <option value="4">Other</option>
                                                    <option value="4">Hallway / Corridor</option>
                                                    <option value="4">Office</option>
                                                    <option value="4">Den</option>
                                                    <option value="4">Nursery</option>
                                                    <option value="4">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="col-12 mb-3 my-3">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary"
                                                        @click.prevent="prevNoFloorPlan()">Previous
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom3 === '2' || valid === true && stageroom3 === '3' || valid === true && stageroom3 === '4' || valid === true && stageroom3 === '5' || valid === true && stageroom3 === '6' || valid === true && stageroom3 === '7' || valid === true && stageroom3 === '8' || valid === true && stageroom3 === '9' || valid === true && stageroom3 === '10' || valid === true && stageroom3 === '11' || valid === true && stageroom3 === '12'"
                                                        @click.prevent="nextNotBath()">Next
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom3 === '1'"
                                                        @click.prevent="next()">Next
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 19" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom3" name="statusbathroom3">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom3 === '1'"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom3 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 20" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                     name="bathroomcurrent3"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" id="ceiling1" type="radio"
                                                                v-model="bathroomcurrent3" name="bathroomcurrent3">
                                                        <p style="display: inline">Bathhub</p></div>
                                                    <div><input value="2" id="ceiling2" type="radio"
                                                                v-model="bathroomcurrent3" name="bathroomcurrent3">
                                                        <p style="display: inline">Walk-in Shower</p></div>
                                                    <div><input value="3" id="ceiling3" type="radio"
                                                                v-model="bathroomcurrent3" name="bathroomcurrent3">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3,4,5" name="bathroomreplace1"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomreplace3"
                                                                name="bathroomreplace3">
                                                        <p style="display: inline">New Bathub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomreplace3"
                                                                name="bathroomreplace3">
                                                        <p style="display: inline">New Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomreplace3"
                                                                name="bathroomreplace3">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent3 !== null & bathroomreplace3 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 21" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling3" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling3" name="ceiling3"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling3" name="ceiling3"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling3" name="ceiling3"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling3" name="ceiling3"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling3" name="ceiling3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls3"
                                                                   name="walls3"></td>
                                                        <td><input value="2" type="radio" v-model="walls3"
                                                                   name="walls3"></td>
                                                        <td><input value="3" type="radio" v-model="walls3"
                                                                   name="walls3"></td>
                                                        <td><input value="4" type="radio" v-model="walls3"
                                                                   name="walls3"></td>
                                                        <td><input value="5" type="radio" v-model="walls3"
                                                                   name="walls3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition3"
                                                                   name="wallpartition3"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition3"
                                                                   name="wallpartition3"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition3"
                                                                   name="wallpartition3"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition3"
                                                                   name="wallpartition3"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition3"
                                                                   name="wallpartition3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor3"
                                                                   name="floor3"></td>
                                                        <td><input value="2" type="radio" v-model="floor3"
                                                                   name="floor3"></td>
                                                        <td><input value="3" type="radio" v-model="floor3"
                                                                   name="floor3"></td>
                                                        <td><input value="4" type="radio" v-model="floor3"
                                                                   name="floor3"></td>
                                                        <td><input value="5" type="radio" v-model="floor3"
                                                                   name="floor3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard3"
                                                                   name="baseboard3"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard3"
                                                                   name="baseboard3"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard3"
                                                                   name="baseboard3"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard3"
                                                                   name="baseboard3"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard3"
                                                                   name="baseboard3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding3"
                                                                   name="crownmolding3"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding3"
                                                                   name="crownmolding3"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding3"
                                                                   name="crownmolding3"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding3"
                                                                   name="crownmolding3"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding3"
                                                                   name="crownmolding3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor3"
                                                                   name="interiordoor3"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor3"
                                                                   name="interiordoor3"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor3"
                                                                   name="interiordoor3"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor3"
                                                                   name="interiordoor3"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor3"
                                                                   name="interiordoor3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor3"
                                                                   name="closestdoor3"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor3"
                                                                   name="closestdoor3"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor3"
                                                                   name="closestdoor3"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor3"
                                                                   name="closestdoor3"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor3"
                                                                   name="closestdoor3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization3"
                                                                   name="closestorganization3"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization3"
                                                                   name="closestorganization3"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization3"
                                                                   name="closestorganization3"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization3"
                                                                   name="closestorganization3"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization3"
                                                                   name="closestorganization3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window3"
                                                                   name="window3"></td>
                                                        <td><input value="2" type="radio" v-model="window3"
                                                                   name="window3"></td>
                                                        <td><input value="3" type="radio" v-model="window3"
                                                                   name="window3"></td>
                                                        <td><input value="4" type="radio" v-model="window3"
                                                                   name="window3"></td>
                                                        <td><input value="5" type="radio" v-model="window3"
                                                                   name="window3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture3"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture3"
                                                                   name="lightfixture3"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture3"
                                                                   name="lightfixture3"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture3"
                                                                   name="lightfixture3"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture3"
                                                                   name="lightfixture3"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture3"
                                                                   name="lightfixture3"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <span v-if="ceiling3 === null && walls3 === null && wallpartition3 === null && floor3 === null && baseboard3 === null && crownmolding3 === null && interiordoor3 === null && closestdoor3 === null && closestorganization3 === null && window3 === null && lightfixture3 === null"
                                                              class="invalid">Select each row</span>
                                                    </div>
                                                </div>
                                            </table>
                                            <div v-if="stageroom3 === '1' || stageroom3 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight3"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="recessedlight3"
                                                                       name="recessedlight3"></td>
                                                            <td><input value="2" type="radio" v-model="recessedlight3"
                                                                       name="recessedlight3"></td>
                                                            <td><input value="3" type="radio" v-model="recessedlight3"
                                                                       name="recessedlight3"></td>
                                                            <td><input value="4" type="radio" v-model="recessedlight3"
                                                                       name="recessedlight3"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture3"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture3"
                                                                       name="wallfixture3"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture3"
                                                                       name="wallfixture3"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture3"
                                                                       name="wallfixture3"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture3"
                                                                       name="wallfixture3"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture3"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture3"
                                                                       name="ceilingfixture3"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture3"
                                                                       name="ceilingfixture3"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture3"
                                                                       name="ceilingfixture3"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture3"
                                                                       name="ceilingfixture3"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling3 === null && walls3 === null && wallpartition3 === null && floor3 === null && baseboard3 === null && crownmolding3 === null && interiordoor3 === null && closestdoor3 === null && closestorganization3 === null && window3 === null && lightfixture3 === null && recessedlight3 === null && wallfixture3 === null && ceilingfixture3"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom3 === '2' || stageroom3 === '3' || stageroom3 === '4' || stageroom3 === '5' || stageroom3 === '6' || stageroom3 === '7' || stageroom3 === '8' || stageroom3 === '9' || stageroom3 === '10' || stageroom3 === '11' || stageroom3 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom3 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom3 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom3 === '1' || stageroom3 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling3 !== null && walls3 !== null && wallpartition3 !== null && floor3 !== null && baseboard3 !== null && crownmolding3 !== null && interiordoor3 !== null && closestdoor3 !== null && closestorganization3 !== null && window3 !== null && lightfixture3 !== null && recessedlight3 !== null && wallfixture3 !== null && ceilingfixture3 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom3 === '3' || stageroom3 === '4' || stageroom3 === '5' || stageroom3 === '6' || stageroom3 === '7' || stageroom3 === '8' || stageroom3 === '9' || stageroom3 === '10' || stageroom3 === '11' || stageroom3 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling3 !== null && walls3 !== null && wallpartition3 !== null && floor3 !== null && baseboard3 !== null && crownmolding3 !== null && interiordoor3 !== null && closestdoor3 !== null && closestorganization3 !== null && window3 !== null && lightfixture3 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 22" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #3 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize3" name="roomsize3">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #3 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo3" name="roominfo3">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 23" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #3 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition3" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #3 Insiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration3" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #3 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal3"
                                                       name="roominspirationexternal3">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>
                            <div class="field">
                                <div class="form-group">
                                    <label class="form-label">Continue?</label>
                                    <div class="form-control-wrap">
                                        <span><p>Select new room</p><input value="1" type="radio" v-model="newroom4"
                                                                           name="newroom4"></span>
                                        <span><p>Finish</p><input value="2" type="radio" v-model="newroom4"
                                                                  name="newroom4"></span>
                                        <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom4 === '1'"
                                            @click.prevent="next()">Next
                                    </button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom4 === '2'"
                                            type="submit">Send form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>

                    <!-- // ROOM 3-->
                    <!-- ROOM 4 -->


                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 24" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom4" name="stageroom4">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="4">Dining room/option>
                                                    <option value="4">Other</option>
                                                    <option value="4">Hallway / Corridor</option>
                                                    <option value="4">Office</option>
                                                    <option value="4">Den</option>
                                                    <option value="4">Nursery</option>
                                                    <option value="4">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="col-12 mb-3 my-3">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary" @click.prevent="prev()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom4 === '2' || valid === true && stageroom4 === '3' || valid === true && stageroom4 === '4' || valid === true && stageroom4 === '5' || valid === true && stageroom4 === '6' || valid === true && stageroom4 === '7' || valid === true && stageroom4 === '8' || valid === true && stageroom4 === '9' || valid === true && stageroom4 === '10' || valid === true && stageroom4 === '11' || valid === true && stageroom4 === '12'"
                                                        @click.prevent="nextNotBath()">Next
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom4 === '1'"
                                                        @click.prevent="next()">Next
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 25" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom4" name="statusbathroom4">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom4 === '1'"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom4 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 26" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3" v-validate="required"
                                                                     name="bathroomcurrent4"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" id="ceiling1" type="radio"
                                                                v-model="bathroomcurrent4" name="bathroomcurrent4">
                                                        <p style="display: inline">Bathhub</p></div>
                                                    <div><input value="2" id="ceiling2" type="radio"
                                                                v-model="bathroomcurrent4" name="bathroomcurrent4">
                                                        <p style="display: inline">Walk-in Shower</p></div>
                                                    <div><input value="3" id="ceiling3" type="radio"
                                                                v-model="bathroomcurrent4" name="bathroomcurrent4">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #1 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3" name="bathroomreplace4"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomreplace4"
                                                                name="bathroomreplace4">
                                                        <p style="display: inline">New Bathub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomreplace4"
                                                                name="bathroomreplace4">
                                                        <p style="display: inline">New Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomreplace4"
                                                                name="bathroomreplace4">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent4 !== null & bathroomreplace4 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 27" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling4" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling4" name="ceiling4"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling4" name="ceiling4"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling4" name="ceiling4"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling4" name="ceiling4"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling4" name="ceiling4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls4"
                                                                   name="walls4"></td>
                                                        <td><input value="2" type="radio" v-model="walls4"
                                                                   name="walls4"></td>
                                                        <td><input value="3" type="radio" v-model="walls4"
                                                                   name="walls4"></td>
                                                        <td><input value="4" type="radio" v-model="walls4"
                                                                   name="walls4"></td>
                                                        <td><input value="5" type="radio" v-model="walls4"
                                                                   name="walls4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition4"
                                                                   name="wallpartition4"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition4"
                                                                   name="wallpartition4"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition4"
                                                                   name="wallpartition4"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition4"
                                                                   name="wallpartition4"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition4"
                                                                   name="wallpartition4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor4"
                                                                   name="floor4"></td>
                                                        <td><input value="2" type="radio" v-model="floor4"
                                                                   name="floor4"></td>
                                                        <td><input value="3" type="radio" v-model="floor4"
                                                                   name="floor4"></td>
                                                        <td><input value="4" type="radio" v-model="floor4"
                                                                   name="floor4"></td>
                                                        <td><input value="5" type="radio" v-model="floor4"
                                                                   name="floor4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard4"
                                                                   name="baseboard4"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard4"
                                                                   name="baseboard4"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard4"
                                                                   name="baseboard4"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard4"
                                                                   name="baseboard4"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard4"
                                                                   name="baseboard4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding4"
                                                                   name="crownmolding4"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding4"
                                                                   name="crownmolding4"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding4"
                                                                   name="crownmolding4"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding4"
                                                                   name="crownmolding4"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding4"
                                                                   name="crownmolding4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor4"
                                                                   name="interiordoor4"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor4"
                                                                   name="interiordoor4"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor4"
                                                                   name="interiordoor4"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor4"
                                                                   name="interiordoor4"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor4"
                                                                   name="interiordoor4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor4"
                                                                   name="closestdoor4"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor4"
                                                                   name="closestdoor4"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor4"
                                                                   name="closestdoor4"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor4"
                                                                   name="closestdoor4"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor4"
                                                                   name="closestdoor4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization4"
                                                                   name="closestorganization4"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization4"
                                                                   name="closestorganization4"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization4"
                                                                   name="closestorganization4"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization4"
                                                                   name="closestorganization4"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization4"
                                                                   name="closestorganization4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window4"
                                                                   name="window4"></td>
                                                        <td><input value="2" type="radio" v-model="window4"
                                                                   name="window4"></td>
                                                        <td><input value="3" type="radio" v-model="window4"
                                                                   name="window4"></td>
                                                        <td><input value="4" type="radio" v-model="window4"
                                                                   name="window4"></td>
                                                        <td><input value="5" type="radio" v-model="window4"
                                                                   name="window4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture4"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture4"
                                                                   name="lightfixture4"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture4"
                                                                   name="lightfixture4"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture4"
                                                                   name="lightfixture4"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture4"
                                                                   name="lightfixture4"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture4"
                                                                   name="lightfixture4"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <span v-if="ceiling4 === null && walls4 === null && wallpartition4 === null && floor4 === null && baseboard4 === null && crownmolding4 === null && interiordoor4 === null && closestdoor4 === null && closestorganization4 === null && window4 === null && lightfixture4 === null"
                                                              class="invalid">Select each row</span>
                                                    </div>
                                                </div>
                                            </table>
                                            <div v-if="stageroom4 === '1' || stageroom4 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight4"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="recessedlight4"
                                                                       name="recessedlight4"></td>
                                                            <td><input value="2" type="radio" v-model="recessedlight4"
                                                                       name="recessedlight4"></td>
                                                            <td><input value="3" type="radio" v-model="recessedlight4"
                                                                       name="recessedlight4"></td>
                                                            <td><input value="4" type="radio" v-model="recessedlight4"
                                                                       name="recessedlight4"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture4"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture4"
                                                                       name="wallfixture4"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture4"
                                                                       name="wallfixture4"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture4"
                                                                       name="wallfixture4"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture4"
                                                                       name="wallfixture4"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture4"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture4"
                                                                       name="ceilingfixture4"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture4"
                                                                       name="ceilingfixture4"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture4"
                                                                       name="ceilingfixture4"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture4"
                                                                       name="ceilingfixture4"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling4 === null && walls4 === null && wallpartition4 === null && floor4 === null && baseboard4 === null && crownmolding4 === null && interiordoor4 === null && closestdoor4 === null && closestorganization4 === null && window4 === null && lightfixture4 === null && recessedlight4 === null && wallfixture4 === null && ceilingfixture4"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom4 === '2' || stageroom4 === '3' || stageroom4 === '4' || stageroom4 === '5' || stageroom4 === '6' || stageroom4 === '7' || stageroom4 === '8' || stageroom4 === '9' || stageroom4 === '10' || stageroom4 === '11' || stageroom4 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom4 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom4 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom4 === '1' || stageroom4 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling4 !== null && walls4 !== null && wallpartition4 !== null && floor4 !== null && baseboard4 !== null && crownmolding4 !== null && interiordoor4 !== null && closestdoor4 !== null && closestorganization4 !== null && window4 !== null && lightfixture4 !== null && recessedlight4 !== null && wallfixture4 !== null && ceilingfixture4 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom4 === '3' || stageroom4 === '4' || stageroom4 === '5' || stageroom4 === '6' || stageroom4 === '7' || stageroom4 === '8' || stageroom4 === '9' || stageroom4 === '10' || stageroom4 === '11' || stageroom4 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling4 !== null && walls4 !== null && wallpartition4 !== null && floor4 !== null && baseboard4 !== null && crownmolding4 !== null && interiordoor4 !== null && closestdoor4 !== null && closestorganization4 !== null && window4 !== null && lightfixture4 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 28" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #4 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize4" name="roomsize4">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #4 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo4" name="roominfo4">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 29" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #4 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition4" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #4 Insiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration4" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #4 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal4"
                                                       name="roominspirationexternal4">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>
                            <div class="field">
                                <div class="form-group">
                                    <label class="form-label">Continue?</label>
                                    <div class="form-control-wrap">
                                        <span><p>Select new room</p><input value="1" type="radio" v-model="newroom5"
                                                                           name="newroom5"></span>
                                        <span><p>Finish</p><input value="2" type="radio" v-model="newroom5"
                                                                  name="newroom5"></span>
                                        <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom5 === '1'"
                                            @click.prevent="next()">Next
                                    </button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom5 === '2'"
                                            type="submit">Send form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>

                    <!-- // ROOM 4-->
                    <!-- ROOM 5 -->


                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 30" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom5" name="stageroom5">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="4">Dining room/option>
                                                    <option value="4">Other</option>
                                                    <option value="4">Hallway / Corridor</option>
                                                    <option value="4">Office</option>
                                                    <option value="4">Den</option>
                                                    <option value="4">Nursery</option>
                                                    <option value="4">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="col-12 mb-3 my-3">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary" @click.prevent="prev()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom5 === '2' || valid === true && stageroom5 === '3' || valid === true && stageroom5 === '4' || valid === true && stageroom5 === '5' || valid === true && stageroom5 === '6' || valid === true && stageroom5 === '7' || valid === true && stageroom5 === '8' || valid === true && stageroom5 === '9' || valid === true && stageroom5 === '10' || valid === true && stageroom5 === '11' || valid === true && stageroom5 === '12'"
                                                        @click.prevent="nextNotBath()">Next
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom5 === '1'"
                                                        @click.prevent="next()">Next
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 31" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom5" name="statusbathroom5">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom5 === '1'"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom5 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 32" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #5 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3" v-validate="required"
                                                                     name="bathroomcurrent5"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomcurrent5"
                                                                name="bathroomcurrent5">
                                                        <p style="display: inline">Bathhub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomcurrent5"
                                                                name="bathroomcurrent5">
                                                        <p style="display: inline">Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomcurrent5"
                                                                name="bathroomcurrent5">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #5 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3" name="bathroomreplace5"
                                                                     v-slot="{ errors, failed }">
                                                    <div><input value="1" type="radio" v-model="bathroomreplace5"
                                                                name="bathroomreplace5">
                                                        <p style="display: inline">New Bathub</p></div>
                                                    <div><input value="2" type="radio" v-model="bathroomreplace5"
                                                                name="bathroomreplace5">
                                                        <p style="display: inline">New Walk-in Shower</p></div>
                                                    <div><input value="3" type="radio" v-model="bathroomreplace5"
                                                                name="bathroomreplace5">
                                                        <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent5 !== null & bathroomreplace5 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 33" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling5" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling5" name="ceiling5"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling5" name="ceiling5"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling5" name="ceiling5"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling5" name="ceiling5"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling5" name="ceiling5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls5"
                                                                   name="walls5"></td>
                                                        <td><input value="2" type="radio" v-model="walls5"
                                                                   name="walls5"></td>
                                                        <td><input value="3" type="radio" v-model="walls5"
                                                                   name="walls5"></td>
                                                        <td><input value="4" type="radio" v-model="walls5"
                                                                   name="walls5"></td>
                                                        <td><input value="5" type="radio" v-model="walls5"
                                                                   name="walls5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition5"
                                                                   name="wallpartition5"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition5"
                                                                   name="wallpartition5"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition5"
                                                                   name="wallpartition5"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition5"
                                                                   name="wallpartition5"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition5"
                                                                   name="wallpartition5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor5"
                                                                   name="floor5"></td>
                                                        <td><input value="2" type="radio" v-model="floor5"
                                                                   name="floor5"></td>
                                                        <td><input value="3" type="radio" v-model="floor5"
                                                                   name="floor5"></td>
                                                        <td><input value="4" type="radio" v-model="floor5"
                                                                   name="floor5"></td>
                                                        <td><input value="5" type="radio" v-model="floor5"
                                                                   name="floor5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard5"
                                                                   name="baseboard5"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard5"
                                                                   name="baseboard5"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard5"
                                                                   name="baseboard5"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard5"
                                                                   name="baseboard5"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard5"
                                                                   name="baseboard5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding5"
                                                                   name="crownmolding5"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding5"
                                                                   name="crownmolding5"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding5"
                                                                   name="crownmolding5"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding5"
                                                                   name="crownmolding5"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding5"
                                                                   name="crownmolding5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor5"
                                                                   name="interiordoor5"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor5"
                                                                   name="interiordoor5"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor5"
                                                                   name="interiordoor5"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor5"
                                                                   name="interiordoor5"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor5"
                                                                   name="interiordoor5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor5"
                                                                   name="closestdoor5"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor5"
                                                                   name="closestdoor5"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor5"
                                                                   name="closestdoor5"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor5"
                                                                   name="closestdoor5"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor5"
                                                                   name="closestdoor5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization5"
                                                                   name="closestorganization5"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization5"
                                                                   name="closestorganization5"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization5"
                                                                   name="closestorganization5"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization5"
                                                                   name="closestorganization5"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization5"
                                                                   name="closestorganization5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window5"
                                                                   name="window5"></td>
                                                        <td><input value="2" type="radio" v-model="window5"
                                                                   name="window5"></td>
                                                        <td><input value="3" type="radio" v-model="window5"
                                                                   name="window5"></td>
                                                        <td><input value="4" type="radio" v-model="window5"
                                                                   name="window5"></td>
                                                        <td><input value="5" type="radio" v-model="window5"
                                                                   name="window5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture5"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture5"
                                                                   name="lightfixture5"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture5"
                                                                   name="lightfixture5"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture5"
                                                                   name="lightfixture5"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture5"
                                                                   name="lightfixture5"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture5"
                                                                   name="lightfixture5"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <span v-if="ceiling5 === null && walls5 === null && wallpartition5 === null && floor5 === null && baseboard5 === null && crownmolding5 === null && interiordoor5 === null && closestdoor5 === null && closestorganization5 === null && window5 === null && lightfixture5 === null"
                                                              class="invalid">Select each row</span>
                                                    </div>
                                                </div>
                                            </table>
                                            <div v-if="stageroom5 === '1' || stageroom5 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight5"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="recessedlight5"
                                                                       name="recessedlight5"></td>
                                                            <td><input value="2" type="radio" v-model="recessedlight5"
                                                                       name="recessedlight5"></td>
                                                            <td><input value="3" type="radio" v-model="recessedlight5"
                                                                       name="recessedlight5"></td>
                                                            <td><input value="4" type="radio" v-model="recessedlight5"
                                                                       name="recessedlight5"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture5"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture5"
                                                                       name="wallfixture5"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture5"
                                                                       name="wallfixture5"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture5"
                                                                       name="wallfixture5"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture5"
                                                                       name="wallfixture5"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture5"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture5"
                                                                       name="ceilingfixture5"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture5"
                                                                       name="ceilingfixture5"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture5"
                                                                       name="ceilingfixture5"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture5"
                                                                       name="ceilingfixture5"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling5 === null && walls5 === null && wallpartition5 === null && floor5 === null && baseboard5 === null && crownmolding5 === null && interiordoor5 === null && closestdoor5 === null && closestorganization5 === null && window5 === null && lightfixture5 === null && recessedlight5 === null && wallfixture5 === null && ceilingfixture5"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom5 === '2' || stageroom5 === '3' || stageroom5 === '4' || stageroom5 === '5' || stageroom5 === '6' || stageroom5 === '7' || stageroom5 === '8' || stageroom5 === '9' || stageroom5 === '10' || stageroom5 === '11' || stageroom5 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom5 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom5 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom5 === '1' || stageroom5 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling5 !== null && walls5 !== null && wallpartition5 !== null && floor5 !== null && baseboard5 !== null && crownmolding5 !== null && interiordoor5 !== null && closestdoor5 !== null && closestorganization5 !== null && window5 !== null && lightfixture5 !== null && recessedlight5 !== null && wallfixture5 !== null && ceilingfixture5 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom5 === '3' || stageroom5 === '4' || stageroom5 === '5' || stageroom5 === '6' || stageroom5 === '7' || stageroom5 === '8' || stageroom5 === '9' || stageroom5 === '10' || stageroom5 === '11' || stageroom5 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling5 !== null && walls5 !== null && wallpartition5 !== null && floor5 !== null && baseboard5 !== null && crownmolding5 !== null && interiordoor5 !== null && closestdoor5 !== null && closestorganization5 !== null && window5 !== null && lightfixture5 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 34" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #5 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize5" name="roomsize5">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #5 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo5" name="roominfo5">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 35" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #5 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition5" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #5 Insiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration5" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #5 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal5"
                                                       name="roominspirationexternal5">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>
                            <div class="field">
                                <div class="form-group">
                                    <label class="form-label">Continue?</label>
                                    <div class="form-control-wrap">
                                        <span><p>Select new room</p><input value="1" type="radio" v-model="newroom6"
                                                                           name="newroom6"></span>
                                        <span><p>Finish</p><input value="2" type="radio" v-model="newroom6"
                                                                  name="newroom6"></span>
                                        <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom6 === '1'"
                                            @click.prevent="next()">Next
                                    </button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true && newroom6 === '2'"
                                            type="submit">Send form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>

                    <!-- // ROOM 5-->
                    <!-- ROOM 6 -->


                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 36" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="stageroom6" name="stageroom6">
                                                    <option value="1">Bathroom</option>
                                                    <option value="2">Kitchen</option>
                                                    <option value="3">Master Bedroom</option>
                                                    <option value="4">Guest bedroom</option>
                                                    <option value="5">Living room</option>
                                                    <option value="4">Dining room/option>
                                                    <option value="4">Other</option>
                                                    <option value="4">Hallway / Corridor</option>
                                                    <option value="4">Office</option>
                                                    <option value="4">Den</option>
                                                    <option value="4">Nursery</option>
                                                    <option value="4">Basement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="col-12 mb-3 my-3">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary" @click.prevent="prev()">
                                                    Previous
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom6 === '2' || valid === true && stageroom6 === '3' || valid === true && stageroom6 === '4' || valid === true && stageroom6 === '5' || valid === true && stageroom6 === '6' || valid === true && stageroom6 === '7' || valid === true && stageroom6 === '8' || valid === true && stageroom6 === '9' || valid === true && stageroom6 === '10' || valid === true && stageroom6 === '11' || valid === true && stageroom6 === '12'"
                                                        @click.prevent="nextNotBath()">Next
                                                </button>
                                                <button class="btn btn-lg btn-primary"
                                                        v-if="valid === true && stageroom6 === '1'"
                                                        @click.prevent="next()">Next
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 37" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="required" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Select Room</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" :class="{ 'is-danger': failed }"
                                                        v-model="statusbathroom6" name="statusbathroom6">
                                                    <option value="1">Full Renovation</option>
                                                    <option value="2">Partial Repair/Replacement</option>
                                                </select>
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom6 === '1'"
                                                    @click.prevent="next()">Next
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom6 === '2'"
                                                    @click.prevent="nextNoFullRenovation()">Next
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">


                        <div v-show="step === 38" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <div class="card card-bordered">
                                                <p>Room #6 (Bathroom): Currently Have</p>
                                                <validation-provider rules="oneOf:1,2,3  v-validate=" required
                                                " name="bathroomcurrent6" v-slot="{ errors, failed }">
                                                <div><input value="1" id="ceiling1" type="radio"
                                                            v-model="bathroomcurrent6" name="bathroomcurrent6">
                                                    <p style="display: inline">Bathhub</p></div>
                                                <div><input value="2" id="ceiling2" type="radio"
                                                            v-model="bathroomcurrent6" name="bathroomcurrent6">
                                                    <p style="display: inline">Walk-in Shower</p></div>
                                                <div><input value="3" id="ceiling3" type="radio"
                                                            v-model="bathroomcurrent6" name="bathroomcurrent6">
                                                    <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                            <div class="card card-bordered">
                                                <p>Room #6 (Bathroom): Replace With</p>
                                                <validation-provider rules="oneOf:1,2,3 name=" bathroomreplace1
                                                " v-slot="{ errors, failed }">
                                                <div><input value="1" type="radio" v-model="bathroomreplace6"
                                                            name="bathroomreplace6">
                                                    <p style="display: inline">New Bathub</p></div>
                                                <div><input value="2" type="radio" v-model="bathroomreplace6"
                                                            name="bathroomreplace6">
                                                    <p style="display: inline">New Walk-in Shower</p></div>
                                                <div><input value="3" type="radio" v-model="bathroomreplace6"
                                                            name="bathroomreplace6">
                                                    <p style="display: inline">Bathhub and Walk-in Shower</p></div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="bathroomcurrent6 !== null & bathroomreplace6 !== null"
                                                    @click.prevent="next()">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 39" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <div class="form-group">
                                        <label class="form-label">Select Room</label>
                                        <div class="form-control-wrap">

                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Do nothing</th>
                                                    <th>Refinish/Refresh</th>
                                                    <th>Replace</th>
                                                    <th>Remove existing</th>
                                                    <th>Install/Add new</th>
                                                    <th>Required</th>
                                                </tr>
                                                <tr>
                                                    <td>Ceiling</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" v-validate="required"
                                                                         name="ceiling6" v-slot="{ errors, failed }">
                                                        <td><input value="1" id="ceiling1" type="radio"
                                                                   v-model="ceiling6" name="ceiling6"></td>
                                                        <td><input value="2" id="ceiling2" type="radio"
                                                                   v-model="ceiling6" name="ceiling6"></td>
                                                        <td><input value="3" id="ceiling3" type="radio"
                                                                   v-model="ceiling6" name="ceiling6"></td>
                                                        <td><input value="4" id="ceiling4" type="radio"
                                                                   v-model="ceiling6" name="ceiling6"></td>
                                                        <td><input value="5" id="ceiling5" type="radio"
                                                                   v-model="ceiling6" name="ceiling6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Walls</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="walls6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="walls6"
                                                                   name="walls6"></td>
                                                        <td><input value="2" type="radio" v-model="walls6"
                                                                   name="walls6"></td>
                                                        <td><input value="3" type="radio" v-model="walls6"
                                                                   name="walls6"></td>
                                                        <td><input value="4" type="radio" v-model="walls6"
                                                                   name="walls6"></td>
                                                        <td><input value="5" type="radio" v-model="walls6"
                                                                   name="walls6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Wall partition</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="wallpartition6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="wallpartition6"
                                                                   name="wallpartition6"></td>
                                                        <td><input value="2" type="radio" v-model="wallpartition6"
                                                                   name="wallpartition6"></td>
                                                        <td><input value="3" type="radio" v-model="wallpartition6"
                                                                   name="wallpartition6"></td>
                                                        <td><input value="4" type="radio" v-model="wallpartition6"
                                                                   name="wallpartition6"></td>
                                                        <td><input value="5" type="radio" v-model="wallpartition6"
                                                                   name="wallpartition6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Floor</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="floor6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="floor6"
                                                                   name="floor6"></td>
                                                        <td><input value="2" type="radio" v-model="floor6"
                                                                   name="floor6"></td>
                                                        <td><input value="3" type="radio" v-model="floor6"
                                                                   name="floor6"></td>
                                                        <td><input value="4" type="radio" v-model="floor6"
                                                                   name="floor6"></td>
                                                        <td><input value="5" type="radio" v-model="floor6"
                                                                   name="floor6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Baseboard</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="baseboard6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="baseboard6"
                                                                   name="baseboard6"></td>
                                                        <td><input value="2" type="radio" v-model="baseboard6"
                                                                   name="baseboard6"></td>
                                                        <td><input value="3" type="radio" v-model="baseboard6"
                                                                   name="baseboard6"></td>
                                                        <td><input value="4" type="radio" v-model="baseboard6"
                                                                   name="baseboard6"></td>
                                                        <td><input value="5" type="radio" v-model="baseboard6"
                                                                   name="baseboard6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Crown molding</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="crownmolding6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="crownmolding6"
                                                                   name="crownmolding6"></td>
                                                        <td><input value="2" type="radio" v-model="crownmolding6"
                                                                   name="crownmolding6"></td>
                                                        <td><input value="3" type="radio" v-model="crownmolding6"
                                                                   name="crownmolding6"></td>
                                                        <td><input value="4" type="radio" v-model="crownmolding6"
                                                                   name="crownmolding6"></td>
                                                        <td><input value="5" type="radio" v-model="crownmolding6"
                                                                   name="crownmolding6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Interior Door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="interiordoor6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="interiordoor6"
                                                                   name="interiordoor6"></td>
                                                        <td><input value="2" type="radio" v-model="interiordoor6"
                                                                   name="interiordoor6"></td>
                                                        <td><input value="3" type="radio" v-model="interiordoor6"
                                                                   name="interiordoor6"></td>
                                                        <td><input value="4" type="radio" v-model="interiordoor6"
                                                                   name="interiordoor6"></td>
                                                        <td><input value="5" type="radio" v-model="interiordoor6"
                                                                   name="interiordoor6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest door</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="closestdoor6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestdoor6"
                                                                   name="closestdoor6"></td>
                                                        <td><input value="2" type="radio" v-model="closestdoor6"
                                                                   name="closestdoor6"></td>
                                                        <td><input value="3" type="radio" v-model="closestdoor6"
                                                                   name="closestdoor6"></td>
                                                        <td><input value="4" type="radio" v-model="closestdoor6"
                                                                   name="closestdoor6"></td>
                                                        <td><input value="5" type="radio" v-model="closestdoor6"
                                                                   name="closestdoor6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Closest Organization</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5"
                                                                         name="closestorganization6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="closestorganization6"
                                                                   name="closestorganization6"></td>
                                                        <td><input value="2" type="radio" v-model="closestorganization6"
                                                                   name="closestorganization6"></td>
                                                        <td><input value="3" type="radio" v-model="closestorganization6"
                                                                   name="closestorganization6"></td>
                                                        <td><input value="4" type="radio" v-model="closestorganization6"
                                                                   name="closestorganization6"></td>
                                                        <td><input value="5" type="radio" v-model="closestorganization6"
                                                                   name="closestorganization6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Window</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="window6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="window6"
                                                                   name="window6"></td>
                                                        <td><input value="2" type="radio" v-model="window6"
                                                                   name="window6"></td>
                                                        <td><input value="3" type="radio" v-model="window6"
                                                                   name="window6"></td>
                                                        <td><input value="4" type="radio" v-model="window6"
                                                                   name="window6"></td>
                                                        <td><input value="5" type="radio" v-model="window6"
                                                                   name="window6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <tr>
                                                    <td>Light fixture</td>
                                                    <validation-provider rules="oneOf:1,2,3,4,5" name="lightfixture6"
                                                                         v-slot="{ errors, failed }">
                                                        <td><input value="1" type="radio" v-model="lightfixture6"
                                                                   name="lightfixture6"></td>
                                                        <td><input value="2" type="radio" v-model="lightfixture6"
                                                                   name="lightfixture6"></td>
                                                        <td><input value="3" type="radio" v-model="lightfixture6"
                                                                   name="lightfixture6"></td>
                                                        <td><input value="4" type="radio" v-model="lightfixture6"
                                                                   name="lightfixture6"></td>
                                                        <td><input value="5" type="radio" v-model="lightfixture6"
                                                                   name="lightfixture6"></td>
                                                        <td><span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                                        </td>
                                                    </validation-provider>
                                                </tr>
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <span v-if="ceiling6 === null && walls6 === null && wallpartition6 === null && floor6 === null && baseboard6 === null && crownmolding6 === null && interiordoor6 === null && closestdoor6 === null && closestorganization6 === null && window6 === null && lightfixture6 === null"
                                                              class="invalid">Select each row</span>
                                                    </div>
                                                </div>
                                            </table>
                                            <div v-if="stageroom6 === '1' || stageroom6 === '2'">
                                                <label class="form-label">Preferred Lighting</label>
                                                <table>
                                                    <tr>
                                                        <th></th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Recessed Light</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="recessedlight6"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="recessedlight6"
                                                                       name="recessedlight6"></td>
                                                            <td><input value="2" type="radio" v-model="recessedlight6"
                                                                       name="recessedlight6"></td>
                                                            <td><input value="3" type="radio" v-model="recessedlight6"
                                                                       name="recessedlight6"></td>
                                                            <td><input value="4" type="radio" v-model="recessedlight6"
                                                                       name="recessedlight6"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Wall Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4" name="wallfixture6"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="wallfixture6"
                                                                       name="wallfixture6"></td>
                                                            <td><input value="2" type="radio" v-model="wallfixture6"
                                                                       name="wallfixture6"></td>
                                                            <td><input value="3" type="radio" v-model="wallfixture6"
                                                                       name="wallfixture6"></td>
                                                            <td><input value="4" type="radio" v-model="wallfixture6"
                                                                       name="wallfixture6"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <tr>
                                                        <td>Ceiling Fixture</td>
                                                        <validation-provider rules="oneOf:1,2,3,4"
                                                                             name="ceilingfixture6"
                                                                             v-slot="{ errors, failed }">
                                                            <td><input value="1" type="radio" v-model="ceilingfixture6"
                                                                       name="ceilingfixture6"></td>
                                                            <td><input value="2" type="radio" v-model="ceilingfixture6"
                                                                       name="ceilingfixture6"></td>
                                                            <td><input value="3" type="radio" v-model="ceilingfixture6"
                                                                       name="ceilingfixture6"></td>
                                                            <td><input value="4" type="radio" v-model="ceilingfixture6"
                                                                       name="ceilingfixture6"></td>
                                                            <td><span v-if="failed"
                                                                      class="invalid">@{{ errors[0] }}</span></td>
                                                        </validation-provider>
                                                    </tr>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <span v-if="ceiling6 === null && walls6 === null && wallpartition6 === null && floor6 === null && baseboard6 === null && crownmolding6 === null && interiordoor6 === null && closestdoor6 === null && closestorganization6 === null && window6 === null && lightfixture6 === null && recessedlight6 === null && wallfixture6 === null && ceilingfixture6"
                                                                  class="invalid">Select each row</span>
                                                        </div>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 my-3">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary"
                                                    v-if="stageroom6 === '2' || stageroom6 === '3' || stageroom6 === '4' || stageroom6 === '5' || stageroom6 === '6' || stageroom6 === '7' || stageroom6 === '8' || stageroom6 === '9' || stageroom6 === '10' || stageroom6 === '11' || stageroom6 === '12'"
                                                    @click.prevent="prevNotBath()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom6 === '1'"
                                                    @click.prevent="prev()">Previous
                                            </button>
                                            <button class="btn btn-lg btn-primary" v-if="statusbathroom6 === '2'"
                                                    @click.prevent="prevNoFullRenovation()">Previous
                                            </button>
                                            <span v-if="stageroom6 === '1' || stageroom6 === '2'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling6 !== null && walls6 !== null && wallpartition6 !== null && floor6 !== null && baseboard6 !== null && crownmolding6 !== null && interiordoor6 !== null && closestdoor6 !== null && closestorganization6 !== null && window6 !== null && lightfixture6 !== null && recessedlight6 !== null && wallfixture6 !== null && ceilingfixture6 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                            <span v-if="stageroom6 === '3' || stageroom6 === '4' || stageroom6 === '5' || stageroom6 === '6' || stageroom6 === '7' || stageroom6 === '8' || stageroom6 === '9' || stageroom6 === '10' || stageroom6 === '11' || stageroom6 === '12'"><button
                                                        class="btn btn-lg btn-primary"
                                                        v-if="ceiling6 !== null && walls6 !== null && wallpartition6 !== null && floor6 !== null && baseboard6 !== null && crownmolding6 !== null && interiordoor6 !== null && closestdoor6 !== null && closestorganization6 !== null && window6 !== null && lightfixture6 !== null"
                                                        @click.prevent="next()">Next</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 40" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #6 Length and Width</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Type" v-model="roomsize6" name="roomsize6">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="" v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #6 Additional Details/Description</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Stage" v-model="roominfo6" name="roominfo6">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="col-12 mb-3 my-3">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                        <button class="btn btn-lg btn-primary" v-if="valid === true"
                                                @click.prevent="next()">Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </validation-observer>
                    <validation-observer v-slot="{ invalid, valid }">
                        <div v-show="step === 41" class="card card-bordered">
                            <div class="card-inner">
                                <div class="field">

                                    <validation-provider rules="required|ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #6 Existing Condition Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roomcondition6" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>@{{
                                                errors[0] }}
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider rules="ext:jpg,png,jpeg|size:102400" immediate
                                                         v-slot="{ errors, validate}">
                                        <div class="form-group">
                                            <label class="form-label">Room #6 Insiration Photo</label>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="file"
                                                       name="roominspiration6" @change="validate">
                                                <span class="invalid">Required. Only jpg, jpeg, png and pdf files allowed.</span>
                                            </div>
                                        </div>
                                    </validation-provider>
                                </div>
                                <div class="field">
                                    <validation-provider v-slot="{ errors, failed }">
                                        <div class="form-group">
                                            <label class="form-label">Room #6 Insiration Photo (Link/URL)</label>
                                            <p>insert a link to your Pinterest board (this is an alternative option in
                                                case you inspiration photos downloaded)</p>
                                            <div class="form-control-wrap">
                                                <input class="form-control" :class="{ 'invalid': failed }" type="text"
                                                       placeholder="Photos from external sources"
                                                       v-model="roominspirationexternal6"
                                                       name="roominspirationexternal6">
                                                <span v-if="failed" class="invalid">@{{ errors[0] }}</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </validation-provider>


                            <div class="col-12 mb-3 my-3">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" @click.prevent="prev()">Previous</button>
                                    <button class="btn btn-lg btn-primary" v-if="valid === true" type="submit">Send
                                        form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </validation-observer>


                    <!-- // ROOM 6-->

                </div>
            </div>
    </form>
    </main>
    </div>


@endsection
@section('page-js')
    <script src="{{ asset('js/app.js') }}"></script>

    <script>

        form = new Vue({
            el: "#form",
            data: {
                step: 1,
                skipStep: 2,
                firstname: null,
                lastname: null,
                email: '',
                message: '',
                is_disable: false,
                dynamic_class: true,
                class_name: '',
                phone: null,

                street1: null,
                street2: null,
                city: null,
                state: null,
                zip: null,

                type: null,
                stage: null,
                startdate: null,
                floorplan: null,
                floorplanfile: null,

                <!-- Room #1 -->
                stageroom1: null,
                statusbathroom1: null,

                bathroomcurrent1: null,
                bathroomreplace1: null,

                ceiling1: null,
                walls1: null,
                wallpartition1: null,
                floor1: null,
                baseboard1: null,
                crownmolding1: null,
                interiordoor1: null,
                closestdoor1: null,
                closestorganization1: null,
                window1: null,
                lightfixture1: null,

                recessedlight1: null,
                wallfixture1: null,
                ceilingfixture1: null,

                roomsize1: null,
                roominfo1: null,

                roomcondition1: null,
                roominspiration1: null,
                roominspirationexternal1: null,
                newroom2: null,

                <!-- Room #2 -->

                stageroom2: null,
                statusbathroom2: null,

                bathroomcurrent2: null,
                bathroomreplace2: null,

                ceiling2: null,
                walls2: null,
                wallpartition2: null,
                floor2: null,
                baseboard2: null,
                crownmolding2: null,
                interiordoor2: null,
                closestdoor2: null,
                closestorganization2: null,
                window2: null,
                lightfixture2: null,

                recessedlight2: null,
                wallfixture2: null,
                ceilingfixture2: null,

                roomsize2: null,
                roominfo2: null,

                roomcondition2: null,
                roominspiration2: null,
                roominspirationexternal2: null,
                newroom3: null,

                <!-- Room #3 -->

                stageroom3: null,
                statusbathroom3: null,

                bathroomcurrent3: null,
                bathroomreplace3: null,

                ceiling3: null,
                walls3: null,
                wallpartition3: null,
                floor3: null,
                baseboard3: null,
                crownmolding3: null,
                interiordoor3: null,
                closestdoor3: null,
                closestorganization3: null,
                window3: null,
                lightfixture3: null,

                recessedlight3: null,
                wallfixture3: null,
                ceilingfixture3: null,

                roomsize3: null,
                roominfo3: null,

                roomcondition3: null,
                roominspiration3: null,
                roominspirationexternal3: null,
                newroom4: null,

                <!-- Room #4 -->

                stageroom4: null,
                statusbathroom4: null,

                bathroomcurrent4: null,
                bathroomreplace4: null,

                ceiling4: null,
                walls4: null,
                wallpartition4: null,
                floor4: null,
                baseboard4: null,
                crownmolding4: null,
                interiordoor4: null,
                closestdoor4: null,
                closestorganization4: null,
                window4: null,
                lightfixture4: null,

                recessedlight4: null,
                wallfixture4: null,
                ceilingfixture4: null,

                roomsize4: null,
                roominfo4: null,

                roomcondition4: null,
                roominspiration4: null,
                roominspirationexternal4: null,
                newroom5: null,

                <!-- Room #5 -->

                stageroom5: null,
                statusbathroom5: null,

                bathroomcurrent5: null,
                bathroomreplace5: null,

                ceiling5: null,
                walls5: null,
                wallpartition5: null,
                floor5: null,
                baseboard5: null,
                crownmolding5: null,
                interiordoor5: null,
                closestdoor5: null,
                closestorganization5: null,
                window5: null,
                lightfixture5: null,

                recessedlight5: null,
                wallfixture5: null,
                ceilingfixture5: null,

                roomsize5: null,
                roominfo5: null,

                roomcondition5: null,
                roominspiration5: null,
                roominspirationexternal5: null,
                newroom6: null,

                <!-- Room #6 -->

                stageroom6: null,
                statusbathroom6: null,

                bathroomcurrent6: null,
                bathroomreplace6: null,

                ceiling6: null,
                walls6: null,
                wallpartition6: null,
                floor6: null,
                baseboard6: null,
                crownmolding6: null,
                interiordoor6: null,
                closestdoor6: null,
                closestorganization6: null,
                window6: null,
                lightfixture6: null,

                recessedlight6: null,
                wallfixture6: null,
                ceilingfixture6: null,

                roomsize6: null,
                roominfo6: null,

                roomcondition6: null,
                roominspiration6: null,
                roominspirationexternal6: null


            },
            methods: {
                submit() {
                    window.alert(`Submitted ${this.firstname} and ${this.lastname}`);
                },
                prev() {
                    this.step--;
                },
                next() {
                    this.step++;
                },
                nextNoFloorPlan() {
                    this.step = 6;
                },
                prevNoFloorPlan() {
                    this.step = 4;
                },
                nextNoFullRenovation() {
                    return this.step = this.step + 2;
                },
                prevNoFullRenovation() {
                    return this.step = this.step - 2;
                },
                nextNotBath() {
                    return this.step = this.step + 3;
                },
                prevNotBath() {
                    return this.step = this.step - 3;
                },
                check: function () {
                    var email = form.email.trim();

                    if (email.length > 2) {
                        axios.post('initial-form/email', {
                            email: email
                        }).then(function (response) {
                            if (response.data === 2) {
                                form.dynamic_class = true;
                                form.message = 'Not taken';
                                form.is_disable = false;
                                form.class_name = 'success';
                            } else {
                                form.dynamic_class = false;
                                form.message = 'Email is taken';
                                form.is_disable = true;
                                form.class_name = 'invalid';
                            }
                        })

                    }

                }


            },
        });
    </script>


@endsection
