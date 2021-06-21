<template>
    <div>
        <div class="container mb-5">
            <a class="dev-detail-nav-back" :href="'./../'"><i class="far fa-arrow-circle-left fa-2x"></i></a>
            <h4 class="devotion-subtitle small font-italic">{{ this.devotion.header_title }}</h4>
            <h2 class="devotion-title">{{ this.devotion.title }}</h2>
            <h5 class="devotion-date small">{{ this.devotion.date_display }}</h5>
            <div class="devotion-bible-verse">
                <h5 v-if="this.devotion.lang=='en'">Bible Verse</h5>
                <h5 v-if="this.devotion.lang=='id'">Ayat Alkitab</h5>
                <ul class="verse-list-holder" v-for="verse in this.devotion.verse" :key="verse.id">
                    <li>
                        <span class="verse-caption-title" v-on:click="displayVerse(verse.id)">{{ verse.verse }}</span>
                        <div class="verse-content-holder" v-show="false" :id="'verse-'+verse.id">
                            <div class="verse-content" v-html="verse.content"></div>
                            <div class="font-italic mt-2 mb-2">{{ verse.verse }} (<span class="verse-version">{{ verse.version }}</span>)</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="devotion-list-cover mb-3 mt-3" v-if="this.devotion.img_cover != null">
                <img :src=" this.devotion.img_cover "  />
            </div>
            <div class="devotion-list-content mb-5" v-html="this.devotion.content"></div>
        </div>
        <footbar></footbar>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                devotion:[]
            }
        },
        created() {
            this.$params    = {permalink:this.$route.params.permalink};
        },
        async mounted() {
            axios.get('./../api/get/devotion-detail/'+this.$params.permalink)
                .then(response=>{
                    if(response.data == false) {
                        this.$router.push('/calendar-plan');
                    }
                    this.devotion=response.data;
                }).catch((error)=>console.log(error));;
        },
        methods: {
            displayVerse: function (targetID) {
                var target  = 'verse-'+targetID;
                if(document.getElementById(target).style.display == 'none') {
                    document.getElementById(target).style.display = 'block';
                } else {
                    document.getElementById(target).style.display = 'none';
                }
            }
        }
    }
</script>