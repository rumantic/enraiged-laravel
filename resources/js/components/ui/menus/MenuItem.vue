<template>
    <li class="item">
        <dl class="option cursor-pointer"
            :class="{ 'has-children': item.menu, 'is-active': current, 'is-open': item.open }"
            @click="handle">
            <dt class="icon">
                <i :class="item.icon"></i>
            </dt>
            <dl class="text">
                {{ i18n(name) }}
            </dl>
            <dt class="icon open-indicator" v-if="item.menu">
                <i class="pi pi-angle-down" v-if="item.open"></i>
                <i class="pi pi-angle-up" v-else></i>
            </dt>
        </dl>
        <menu-group v-if="item.menu"
            :menu="item.menu"
            :open="item.open"
            @menu:navigate="$emit('menu:navigate')"/>
    </li>
</template>

<script>
import MenuGroup from '@/components/ui/menus/MenuGroup.vue';

export default {
    components: {
        MenuGroup,
    },

    inject: ['i18n', 'meta'],

    props: {
        item: {
            type: Object,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        active: false,
    }),

    computed: {
        current() {
            return this.item.route === '/'
                ? (this.$page.url === '/' || this.$page.url === this.meta.app_home)
                : this.$page.url.indexOf(this.item.route) === 0;
        },
        page() {
            return this.$page.url.substr(1);
        },
    },

    methods: {
        handle() {
            if (this.item.menu) {
                this.item.open = !this.item.open;
            } else {
                this.$emit('menu:navigate');
                this.$inertia.get(this.item.route);
            }
        },
    },
};
</script>
