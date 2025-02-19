<script>
import { computed } from 'vue';

export default {
    emits: ['close:all', 'close:auth', 'close:menu'],

    inject: ['isMobile', 'isSuccess'],

    props: {
        api: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        menu: null,
        meta: null,
        ready: false,
        user: null,
        authMenuOpen: false,
        mainMenuOpen: false,
    }),

    computed: {
        getMenu() {
            return this.menu;
        },

        getMeta() {
            return this.meta;
        },

        getUser() {
            return this.user;
        },

        menuClass() {
            const state = {
                'auth-open': this.authMenuOpen,
                'menu-open': this.mainMenuOpen === true,
                'menu-closed': this.mainMenuOpen === false,
            };

            return Object.keys(state)
                .filter((value) => state[value] === true)
                .join(' ');
        },
    },

    created() {
        this.mainMenuOpen = (this.isMobile !== true);
        this.initState();
    },

    methods: {
        closeAll() {
            this.authMenuOpen = false;
            this.mainMenuOpen = false;
        },

        closeAuth() {
            this.authMenuOpen = false;
        },

        closeMenu() {
            this.mainMenuOpen = false;
        },

        initState() {
            this.axios.get(this.api)
                .then(response => this.fetched(response));
        },

        fetched(response) {
            const { status, data } = response;
            if (this.isSuccess(status)) {
                const { i18n, menu, meta, user } = data;
                let lang = meta.language;
                if (user) {
                    lang = user.language;
                    this.setUser(user);
                }
                this.$root.$i18n.locale = lang;
                this.$root.$i18n.setLocaleMessage(lang, i18n[lang]);
                this.setMenu(menu);
                this.setMeta(meta);
                this.ready = true;
            }
        },

        setMenu(menu) {
            if (menu) {
                Object.keys(menu).forEach(key => {
                    if (menu[key].menu) {
                        let state = false;
                        Object.values(menu[key].menu).every(item => {
                            if (item.route === this.$page.url) {
                                state = true;
                            }
                        });
                        menu[key].open = state;
                    }
                });
            }
            this.menu = menu;
        },

        setMeta(meta) {
            this.meta = meta;
        },

        setUser(user) {
            this.user = user;
        },

        stopImpersonating() {
            this.$inertia.get('/users/impersonate/stop');
        },

        toggleAuth() {
            this.authMenuOpen = !this.authMenuOpen;
        },

        toggleMenu() {
            if (this.authMenuOpen) {
                this.authMenuOpen = false;
                this.mainMenuOpen = true;
            } else {
                this.mainMenuOpen = !this.mainMenuOpen;
            }
        },
    },

    provide() {
        return {
            closeAllPanels: this.closeAll,
            closeAuthPanel: this.closeAuth,
            closeMainPanel: this.closeMenu,
            initState: this.initState,
            menu: computed(() => this.menu),
            meta: computed(() => this.meta),
            stopImpersonating: this.stopImpersonating,
            toggleAuthPanel: this.toggleAuth,
            toggleMainPanel: this.toggleMenu,
            user: computed(() => this.user),
        };
    },

    render() {
        return this.$slots.default({
            classes: this.menuClass,
            closeAuth: this.closeAuth,
            closeMenu: this.closeMenu,
            menu: this.menu,
            ready: this.ready,
            toggleAuth: this.toggleAuth,
            toggleMenu: this.toggleMenu,
            user: this.user,
        });
    },

    watch: {
        '$page.props.flash': {
            handler() {
                const flash = this.$page.props.flash;
                switch (flash.status) {
                    case 205:
                        this.initState();
                        break;
                }
            },
            deep: true,
        },
    },
};
</script>
