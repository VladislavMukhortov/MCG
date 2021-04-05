<script type="text/x-template" id="line-items-node-parent-template">
    <div>
        <div v-if="tree" v-for="item in tree">
            <line-items-node
                    :key="`${item.id}`"
                    :tree="tree"
                    :node="item"
                    :level="0"
                    :removeFromTree="removeFromTree"
                    :calculateTotal="calculateTotal"
                    :submitTree="submitTree"
            ></line-items-node>
        </div>
        <div class="table__row total__summary">
            <div class="table--left">
                <div><b>@{{ _.isEmpty(tree) ? 'No Item' : 'Total' }}</b></div>
            </div>
            <div class="table--right">
                <div class="total__summary__content">@{{ total.quantity || '0' }}</div>
                <div class="total__summary__content">$@{{ total.building_material || '0.00' }}</div>
                <div class="total__summary__content">$@{{ total.decoration_material || '0.00' }}</div>
                <div class="total__summary__content">$@{{ total.subcontractors || '0.00' }}</div>
                <div class="total__summary__content">$@{{ total.labor || '0.00' }}</div>
                <div class="total__summary__content">$@{{ total.summary || '0.00' }}</div>
                <div></div>
            </div>
        </div>
    </div>
</script>

<script type="text/x-template" id="line-items-node-template">
    <div class="table__item_container">
        <div class="table__row">
            <div class="table--left">
                <div :style="{paddingLeft: padding}">
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
                    />&nbsp
                    <em class="icon ni ni-check-circle"
                        @click="submitTree()">
                    </em>
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

                <div class="text-center">
                    <em class="icon ni ni-cross-circle"
                        style="color:#6576ff"
                        @click.prevent="removeFromTree(tree, node.id, node.type)"
                    >Delete
                    </em>
                </div>
            </div>
        </div>

        <div v-for="child in node.children">
            <line-items-node v-if="node.children"
                             :calculateTotal="calculateTotal"
                             :key="`${child.id}`"
                             :tree="tree"
                             :node="child"
                             :removeFromTree="removeFromTree"
                             :submitTree="submitTree"
                             :level="level + 1"></line-items-node>
        </div>
    </div>
</script>
