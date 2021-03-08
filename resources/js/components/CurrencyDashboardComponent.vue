<template>
    <v-container>
        <v-row>
            <v-col>
                <div class="text-lg font-semibold">Chaos equivalent</div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="6" v-show="isLoading">
                <v-card elevation="2">
                    <v-skeleton-loader type="article"></v-skeleton-loader>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" v-show="isLoading">
                <v-card elevation="2">
                    <v-skeleton-loader type="article"></v-skeleton-loader>
                </v-card>
            </v-col>
            <v-col
                cols="12"
                sm="6"
                v-for="(league, index) in leagues"
                :key="index"
            >
                <v-card elevation="2" v-show="!isLoading">
                    <v-card-title class="text-base font-semibold">
                        {{ league.id }}
                    </v-card-title>
                    <v-card-text v-if="undefined !== league.currencyOverview">
                        <v-simple-table>
                            <template v-slot:default>
                                <tbody>
                                    <tr
                                        v-for="(line, i) in league
                                            .currencyOverview.lines"
                                        :key="i"
                                    >
                                        <td>
                                            <v-avatar tile size="32">
                                                <v-img
                                                    :src="
                                                        findCurrencyIcon(
                                                            index,
                                                            line.currencyTypeName
                                                        )
                                                    "
                                                    :alt="line.currencyTypeName"
                                                    height="32"
                                                ></v-img>
                                            </v-avatar>
                                            {{ line.currencyTypeName }}
                                        </td>
                                        <td>{{ line.chaosEquivalent }}</td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
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
            leagues: {},
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
                this.leagues = _.dropRight(res.data, 2);
                var self = this;
                _.forEach(this.leagues, async function (item) {
                    self.$set(
                        item,
                        "currencyOverview",
                        await self.currencyOverview(item.id)
                    );
                });
                this.isLoading = false;
            });
    },
    methods: {
        async currencyOverview(league) {
            return axios
                .get("/api/v1/poe/currencyOverview", {
                    params: {
                        league: league,
                        type: "Currency",
                    },
                })
                .then((res) => res.data);
        },
        findCurrencyIcon(leagueIndex, currencyName) {
            return _.find(
                this.leagues[leagueIndex].currencyOverview.currencyDetails,
                function (o) {
                    return o.name === currencyName;
                }
            ).icon;
        },
    },
};
</script>
