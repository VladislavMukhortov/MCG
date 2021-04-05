<script type="text/x-template" id="node-template">
    <div class="table__item_container" :data-index="node.id" :class="{droppable: node.data && node.data.custom}">
        <div class="table__row">
            <div class="table--left">
                <div :style="{paddingLeft: padding}">
                    <em class="icon ni ni-cross-circle"
                        style="color:red"
                        @click="removeFromTree(tree, node.id, node.type)"
                    >
                    </em>&nbsp
                    <em v-if="node.type === 2" class="icon ni ni-folder"></em>
                    <em v-else class="icon ni ni-list"></em> &nbsp;
                    @{{ node.name }}
                </div>
            </div>

            <div v-if="node.type == 1" class="table--right">
                <div>
                    <input
                        value="1"
                        type="number"
                        class="form-control minified"
                        v-model="node.data.quantity"
                        @change="calculateTotal()"
                    />
                </div>
                <div class="text-center">
                    $@{{ getValue('building_material').toFixed(1) }}
                </div>
                <div class="text-center">
                    $@{{ getValue('decoration_material').toFixed(1) }}
                </div>
                <div class="text-center">
                    $@{{ getValue('subcontractors').toFixed(1) }}
                </div>
                <div class="text-center">
                    $@{{ getValue('labor').toFixed(1) }}
                </div>
                <div class="text-center">
                    $@{{ getValue('summary').toFixed(1) }}
                </div>
            </div>
        </div>

        <div v-for="child in node.children">
            <node v-if="node.children" :calculateTotal="calculateTotal" :key="`${child.id}`" :tree="tree"
                  :node="child"
                  :removeFromTree="removeFromTree" :level="level + 1"></node>
        </div>
    </div>
</script>

<script type="text/x-template" id="estimate-template-template">
    <div>
        <div class="row">
            <div class="col-md-2">
                <h6>Level 1</h6>
                <ul class="level1">

                    <li v-for="(item, index) in csil1"
                        :id="item.id"
                        :index="index"
                        :level="1"
                        v-on:click="selectNextLevel(index,  item, 1)"
                    >
                        @{{item.code +' '+item.description}}
                    </li>

                </ul>
            </div>
            <div class="col-md-2">
                <h6>Level 2</h6>
                <ul v-if="selected.csil1" class="level2">
                    <li v-for="(item, c2index) in csil2"
                        :id="item.id"
                        :index="c2index"
                        :level="2"
                        v-on:click="selectNextLevel(c2index, item, 2)"
                        :class="{ active: selected.csil2 === item }"
                    >@{{item.code +' '+item.description}}
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6>Level 3</h6>
                <ul v-if="selected.csil2" class="level3">
                    <li v-for="(item, c3index) in csil3"
                        :id="item.id"
                        :index="c3index"
                        :level="3"
                        v-on:click="selectNextLevel(c3index, item, 3)"
                        :class="{ active: selected.csil3 === item }"
                    >@{{item.code +' '+item.description}}
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Level 4</h6>
                <ul class="level4">

                </ul>
            </div>
            <div class="col-md-3">
                <h6>Codes</h6>
                <ul class="all_codes">
                    <li v-for="(item, aindex) in csicodes"
                        class="draggable"
                        :id="item.id"
                        :index="aindex"
                        {{--                            v-on:click="selectNextLevel(aindex, item, 'allcodes')"--}}
                    >@{{item.item_name}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-6">
                <h6>Overview</h6>
            </div>
            <div class="col-md-6 text-right new-folder">
                <div class="input-group">
                    <input type="text" v-model="folderName" class="form-control"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary" @click="() => addNewFolder()">New folder</button>
                    </div>
                </div>
                <button class="btn btn-primary" @click="submitTable({{ $reads->id }})">Submit</button>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <div class="table">
                    <div class="table__head">
                        <div class="table--left">
                            <div>CSI Code</div>
                        </div>
                        <div class="table--right">
                            <div>Quantity</div>
                            <div>BM</div>
                            <div>DM</div>
                            <div>Sub</div>
                            <div>Labor</div>
                            <div>Total</div>
                        </div>
                    </div>
                    <div class="table__body droppable">
                        <div v-if="_.isEmpty(tree)" class="empty-tree">
                            Drop CSI codes here...
                        </div>
                        <node
                            v-if="tree"
                            :key="`${item.id}`"
                            v-for="item in tree"
                            :tree="tree"
                            :node="item"
                            :level="0"
                            :removeFromTree="removeFromTree"
                            :calculateTotal="calculateTotal"
                        ></node>
                    </div>
                </div>
                <div class="table__row">
                    <div class="table--left">
                        <div><b>@{{ _.isEmpty(tree) ? 'No Item' : 'Total' }}</b></div>
                    </div>
                    <div class="table--right">
                        <div>@{{ total.quantity || '0' }}</div>
                        <div>$@{{ total.building_material || '0.00' }}</div>
                        <div>$@{{ total.decoration_material || '0.00' }}</div>
                        <div>$@{{ total.subcontractors || '0.00' }}</div>
                        <div>$@{{ total.labor || '0.00' }}</div>
                        <div>$@{{ total.summary || '0.00' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</script>