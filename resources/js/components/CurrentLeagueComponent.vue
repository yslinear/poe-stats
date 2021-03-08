<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card elevation="2" v-if="isLoading">
                    <v-skeleton-loader type="card, article"></v-skeleton-loader>
                </v-card>
                <v-card class="mx-auto" elevation="2" v-else>
                    <v-img
                        height="250"
                        src="https://cdn.staticneo.com/n/8/path_of_exile_echoes_of_the_atlas_banner_display.jpg"
                    ></v-img>
                    <v-card-title>{{ currentLeague.id }}</v-card-title>
                    <v-card-text>
                        <div class="text-base font-semibold">
                            {{ currentLeague.startAt }}
                        </div>
                        <div class="mb-4 text-sm">
                            {{ elapsedTime }}
                        </div>
                        <div>
                            {{ currentLeague.description }}
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            isLoading: true,
            currentLeague: {},
            elapsedTime: "",
        };
    },
    mounted() {
        axios
            .get("/api/v1/poe/leagues", {
                params: {
                    realm: "pc",
                    offset: 4,
                },
            })
            .then((res) => {
                this.currentLeague = _.head(res.data);

                this.currentLeague.startAt = new Date(
                    this.currentLeague.startAt
                );
                this.time();
                this.isLoading = false;
            });
    },
    methods: {
        time() {
            var self = this;
            var nowtime = new Date();
            var delta = Math.abs(this.currentLeague.startAt - nowtime) / 1000;
            var days = Math.floor(delta / 86400);
            delta -= days * 86400;
            var hours = Math.floor(delta / 3600) % 24;
            delta -= hours * 3600;
            var minutes = Math.floor(delta / 60) % 60;
            delta -= minutes * 60;
            var seconds = Math.floor(delta % 60);
            this.elapsedTime = `${days} days ${hours} hours ${minutes} min ${seconds} sec`;
            setTimeout(self.time, 1000);
        },
    },
};
</script>
