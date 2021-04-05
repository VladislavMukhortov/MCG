<script type="text/x-template" id="lead-project-line-items-node-parent-template">
    <div>
        <div v-if="tree" v-for="item in tree">
            <lead-project-line-items-node
                    :key="`${item.id}`"
                    :tree="tree"
                    :node="item"
                    :level="0"
            ></lead-project-line-items-node>
        </div>
    </div>
</script>

<script type="text/x-template" id="lead-project-line-items-node-template">
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
{{--                    $@{{ getValue('status') }} TODO --}}
                </div>
            </div>
        </div>

        <div v-for="child in node.children">
            <lead-project-line-items-node v-if="node.children"
                             :key="`${child.id}`"
                             :tree="tree"
                             :node="child"
                             :level="level + 1"></lead-project-line-items-node>
        </div>
    </div>
</script>