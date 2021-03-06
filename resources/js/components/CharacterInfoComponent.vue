<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="4">
                <v-card class="p-4" elevation="2" v-if="isLoading">
                    <v-skeleton-loader
                        type="image, list-item-avatar-three-line, list-item-avatar-three-line, list-item-avatar-three-line"
                    ></v-skeleton-loader>
                </v-card>
                <v-card class="p-4" elevation="2" v-else>
                    <div class="text-center">
                        <v-avatar tile size="128" class="rounded mb-4">
                            <v-img
                                :src="`https://poe.ninja/images/classes/${data.class}_avatar.png`"
                                :alt="data.class"
                                height="128"
                            ></v-img>
                        </v-avatar>
                        <div class="text-lg font-semibold">{{ data.name }}</div>
                        <div class="text-base">
                            Level {{ data.level }} {{ data.class }}
                        </div>
                        <div class="text-base">
                            {{ data.league }}
                        </div>
                    </div>
                    <v-divider class="my-4"></v-divider>
                    <div class="text-base font-semibold">Attributes</div>
                    <div class="ml-1 mb-4 text-sm">
                        <div class="flex place-content-between">
                            <div>Strength</div>
                            <div class="text-red-500">
                                {{ data.defensiveStats.strength }}
                            </div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Dexterity</div>
                            <div class="text-green-500">
                                {{ data.defensiveStats.dexterity }}
                            </div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Intelligence</div>
                            <div class="text-blue-500">
                                {{ data.defensiveStats.intelligence }}
                            </div>
                        </div>
                    </div>
                    <div class="text-base font-semibold">Defensive</div>
                    <div class="ml-1 mb-4 text-sm">
                        <div class="flex place-content-between">
                            <div>Life</div>
                            <div>{{ data.defensiveStats.life }}</div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Mana</div>
                            <div>{{ data.defensiveStats.mana }}</div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Energy shield</div>
                            <div>{{ data.defensiveStats.energyShield }}</div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Armour</div>
                            <div>{{ data.defensiveStats.armour }}</div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Evasion rating</div>
                            <div>{{ data.defensiveStats.evasionRating }}</div>
                        </div>
                    </div>
                    <div class="text-base font-semibold">Charges</div>
                    <div class="ml-1 mb-4 text-sm">
                        <div class="flex place-content-between">
                            <div>Endurance charges</div>
                            <div class="text-red-500">
                                {{ data.defensiveStats.enduranceCharges }}
                            </div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Frenzy charges</div>
                            <div class="text-green-500">
                                {{ data.defensiveStats.frenzyCharges }}
                            </div>
                        </div>
                        <div class="flex place-content-between">
                            <div>Power charges</div>
                            <div class="text-blue-500">
                                {{ data.defensiveStats.powerCharges }}
                            </div>
                        </div>
                    </div>
                </v-card>
            </v-col>
            <v-col cols="12" sm="8">
                <v-card class="p-4" elevation="2">
                    <div class="text-base font-semibold">Passive tree</div>
                    <div class="ml-1 mb-4 text-sm">
                        <div>Keystones</div>
                        <div
                            v-for="(keyStone, index) in data.keyStones"
                            :key="index"
                            class="border rounded p-2 mt-2"
                        >
                            <div class="flex">
                                <v-avatar tile size="40" class="rounded mr-2">
                                    <v-img
                                        :src="`https://web.poecdn.com/image/${keyStone.icon}`"
                                        :alt="keyStone.name"
                                        sizes="40"
                                    ></v-img>
                                </v-avatar>
                                <div>
                                    <div>{{ keyStone.name }}</div>
                                    <li
                                        v-for="(item, i) in keyStone.stats"
                                        :key="i"
                                    >
                                        {{ item }}
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
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
            data: {},
        };
    },
    mounted() {
        axios
            .get(`/api/v1/poe/character${window.location.search}`)
            .then((res) => {
                this.data = res.data;
                this.isLoading = false;
            });
    },
    computed: {},
    watch: {},
    methods: {},
};
</script>
