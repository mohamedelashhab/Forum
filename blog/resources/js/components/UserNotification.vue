<template>
    <div v-if="notifications.length">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-5" aria-controls="navbarSupportedContent-5" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-5">
        
            <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="badge badge-danger ml-2" v-text="notifications.length"></span>
                <i class="fas fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
                <a class="dropdown-item waves-effect waves-light" :href="notification.data.link" v-for="notification in notifications" @click="markAsRead(notification)">{{notification.data.message}} 
                <span class="badge badge-danger ml-2"></span></a>
                <!-- <a class="dropdown-item waves-effect waves-light" href="#">Another action <span class="badge badge-danger ml-2">1</span></a>
                <a class="dropdown-item waves-effect waves-light" href="#">Something else here <span class="badge badge-danger ml-2">4</span></a> -->
                </div>
            </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false,
            }
        },

        created() {
            axios.get(`/profiles/${window.App.user.name}/notifications`)
            .then((response)=>{
                this.notifications = response.data;
            });
        },

        methods: {
            markAsRead(notification)
            {
                axios.delete(`/profiles/${window.App.user.name}/notifications/${notification.id}`);
            }
        },
    }
</script>

<style lang="">
    
</style>