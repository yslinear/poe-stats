<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-select
                    v-model="select.league"
                    :items="leagues"
                    v-on:change="select.page = 1"
                    item-text="id"
                    item-value="id"
                    label="League"
                    :loading="isLoading"
                    :disabled="isLoading"
                    single-line
                    dense
                ></v-select>
            </v-col>
            <v-col cols="12">
                <v-simple-table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Character</th>
                            <th scope="col">Level</th>
                            <th scope="col">Account</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ladder, index) in ladders.entries"
                            :key="index"
                        >
                            <td>{{ ladder.rank }}</td>
                            <td>
                                <div class="flex items-center">
                                    <v-avatar tile size="32" class="rounded">
                                        <v-img
                                            :src="`https://poe.ninja/images/classes/${ladder.character.class}_avatar.png`"
                                            :alt="ladder.character.class"
                                            height="32"
                                        ></v-img>
                                    </v-avatar>
                                    <div class="ml-2">
                                        <a
                                            v-if="ladder.public"
                                            target="_blank"
                                            :href="`character?account=${
                                                ladder.account.name
                                            }&name=${
                                                ladder.character.name
                                            }&overview=${select.league
                                                .replaceAll(' ', '-')
                                                .toLowerCase()}`"
                                        >
                                            {{ ladder.character.name }}
                                        </a>
                                        <div v-else>
                                            {{ ladder.character.name }}
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            {{ ladder.character.class }}
                                        </div>
                                    </div>
                                    <div>
                                        <v-icon
                                            v-if="ladder.dead"
                                            dense
                                            class="text-red-500 ml-2"
                                            >mdi-emoticon-dead-outline</v-icon
                                        >
                                        <v-icon
                                            v-if="ladder.retired"
                                            dense
                                            class="text-red-500 ml-2"
                                            >mdi-exit-run</v-icon
                                        >
                                    </div>
                                </div>
                            </td>
                            <td>{{ ladder.character.level }}</td>
                            <td>
                                <div class="flex">
                                    <div>
                                        {{ ladder.account.name }}
                                    </div>
                                    <a
                                        v-if="ladder.public"
                                        class="ml-2 no-underline"
                                        :href="`https://www.pathofexile.com/account/view-profile/${ladder.account.name}/characters`"
                                        target="_blank"
                                    >
                                        <v-icon dense class="text-yellow-800"
                                            >mdi-card-account-details-outline</v-icon
                                        >
                                    </a>
                                    <a
                                        v-if="ladder.account.twitch"
                                        class="ml-2 no-underline"
                                        :href="`https://www.twitch.tv/${ladder.account.twitch.name}`"
                                        target="_blank"
                                    >
                                        <v-icon dense class="text-purple-700"
                                            >mdi-twitch</v-icon
                                        >
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </v-simple-table>
            </v-col>
            <v-col cols="12" v-show="0 < paginationLength">
                <v-pagination
                    class="my-4"
                    v-model="select.page"
                    :length="paginationLength"
                    :loading="isLoading"
                    :disabled="isLoading"
                    total-visible="16"
                ></v-pagination>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            isLoading: true,
            leagues: [],
            ladders: [],
            select: {
                league: null,
                page: 1,
            },
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
                this.leagues = res.data;
                this.isLoading = false;
            });
    },
    computed: {
        paginationLength: function () {
            if (undefined != this.ladders.total)
                return Math.ceil(this.ladders.total / 20);
            return 0;
        },
    },
    watch: {
        select: {
            handler: function () {
                this.isLoading = true;
                axios
                    .get(`/api/v1/poe/ladders/${this.select.league}`, {
                        params: {
                            offset: (this.select.page - 1) * 20,
                        },
                    })
                    .then((res) => {
                        this.ladders = res.data;
                        this.isLoading = false;
                    });
            },
            deep: true,
        },
    },
    methods: {},
};
</script>
