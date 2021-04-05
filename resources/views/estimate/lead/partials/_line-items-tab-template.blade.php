<script type="text/x-template" id="lead-line-items-node-parent-template">
    <div>
        <div v-if="tree" v-for="item in tree">
            <lead-line-items-node
                    :key="`${item.id}`"
                    :tree="tree"
                    :node="item"
                    :level="0"
                    :calculateTotal="calculateTotal"
            ></lead-line-items-node>
        </div>
        <div class="table__row total__summary">
            <div class="table--left">
                <div><b>@{{ _.isEmpty(tree) ? 'No Item' : 'Total' }}</b></div>
            </div>
            <div class="table--right" style="padding-left: 80px">
                <div class="total__summary__content">@{{ total.quantity || '0' }}</div>
                <div class="total__summary__content">$@{{ total.summary || '0.00' }}</div>
            </div>
        </div>
    </div>
</script>

<script type="text/x-template" id="lead-line-items-node-template">
    <div class="table__item_container">
        <div class="table__row" :style="[node.type == 1 ? {borderBottom: '1px solid #F1EEEE'} : {}]">
            <div class="table--left">
                <div :style="{paddingLeft: padding}">
                    @{{ node.name }}
                </div>
            </div>

            <div v-if="node.type == 1" class="table--right">
                <div>
                    @{{ node.data.quantity }}
                </div>
                <div class="text-center">
                    $@{{ getValue('summary') }}
                </div>
            </div>
        </div>

        <div v-for="child in node.children">
            <lead-line-items-node v-if="node.children"
                             :calculateTotal="calculateTotal"
                             :key="`${child.id}`"
                             :tree="tree"
                             :node="child"
                             :level="level + 1"></lead-line-items-node>
        </div>
    </div>
</script>