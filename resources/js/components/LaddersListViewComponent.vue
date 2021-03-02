<template>
    <div class="container">
        <div class="row justify-content-center">
            <nav class="nav">
                <a
                    class="nav-link hover:shadow-md"
                    href="#"
                    v-for="(item, index) in leagues"
                    :key="index"
                >
                    {{ item.id }}
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            leagues: [],
        };
    },
    mounted() {
        axios.get("/api/v1/poe/leagues").then((res) => {
            this.leagues = res.data;
        });
    },
    methods: {},
};
</script>
