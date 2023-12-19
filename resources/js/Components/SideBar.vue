<template>
   <aside class="flex flex-col bg-black-200 py-9 w-full sm:w-1/3 lg:w-1/4">
   
        <inertia-link :href="link.route" v-for="link in sideBarLinks" :key="link.name" class="flex items-end pl-6 py-2" :class="route().current(link.route) ? 'text-gray-800 hover:bg-gray-500 hover:text-white' : 'text-white bg-gray-800 hover:bg-gray-500'">
            <img :src="link.image" :alt="link.alt" class="h-8 w-8 rounded-full object-cover" v-if="link.image">
            <icon :name="link.icon" class="fill-current w-8 h-8" v-if="link.icon"></icon>
            <span class="ml-2">
                {{ link.name }}
            </span>
        </inertia-link>
    
    </aside>
</template>

<script>
    export default {
        computed: {
            sideBarLinks() {
                return [
                    { name: `${this.$page.props.user.username}`, image: `${this.$page.props.user.profile_photo_url}`, alt: `${this.$page.props.user.username}`, route: route('profiles.show',`${this.$page.props.user.username}`) },

                    { name: 'Edit Profile', route: route('profile.show'), icon: 'user-edit' },

                    { name: 'Friends', route: route('friends.index'), icon: 'user-friends' },

                    { name: 'Members', route: route('members.index'), icon: 'users' },

                    { name: 'Chat Rooms', route: route('chat-rooms.index'), icon: 'comments'},

                    { name: 'Add an Event', route: route('events.create'), icon: 'events'},

                    { name: 'Upcoming Events', route: route('events.index'), icon: 'clock'},

                    { name: 'My Tickets', route: route('events.tickets'), icon: 'tickets'},


                ]
            }
        }
    }
</script>
<style>
/* ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: black;
  height:600px;
} */

</style>