<template>
    <div class="min-h-screen">
        <!--
            <a style="bottom: 100px; background-color: black" class="btn-flotante" href="mailto:rafa@gmail.com?Subject=Interesado%20en%20el%20curso">
                <img src="/images/gmail.png" style="width: 33px">
            </a>
         -->

        <a href="#" class="btn-flotante">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
            </svg>
        </a>

        <nav class="border-b border-gray-100" style="background-color: white" >
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <button onclick="location.href='/dashboard'">
                                <img src="/images/ColeMarLogo.png" style="width: 100px">
                            </button>
                        </div>
                    </div>

                    <div id='search-box' class="buttons">
                        <form action='/buscar' id='search-form' method='get' target='_top'>
                            <input id='search-text' name='texto' placeholder='Buscar productos, marcas y más...' type='text'/>
                            <button id='search-button' type='submit'><span>Busca!</span></button>
                        </form>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                                    </button>

                                    <button v-else class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ $page.user.name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Cuenta
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Perfil
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/crearPublicacion">
                                        Publicar
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/publicadas">
                                        Publicados
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/guardadas">
                                        Guardados
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template v-if="$page.jetstream.hasTeamFeatures">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="route('teams.show', $page.user.current_team)">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('teams.create')" v-if="$page.jetstream.canCreateTeams">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div class="border-t border-gray-100"></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Cerrar Sesión
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id='search-box' class="buttons2">
                <form action='/buscar' id='search-form' method='get' target='_top' style="margin-bottom: 20px; margin-left: 15px; width: 340px">
                    <input id='search-text' name='texto' placeholder='Buscar productos, marcas y más...' type='text'/>
                    <button id='search-button' type='submit' style="margin-top: 0px; margin-right: -130px" ><span>Busca!</span></button>
                </form>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                        Inicio
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link class="buttons2" href="/crearPublicacion">
                        Publicar
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link class="buttons2"  href="/publicadas">
                        Publicadas
                    </jet-responsive-nav-link>
                    <jet-responsive-nav-link class="buttons2"  href="/guardadas">
                        Guardadas
                    </jet-responsive-nav-link>

                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                            Profile
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link :href="route('teams.show', $page.user.current_team)" :active="route().current('teams.show')">
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')">
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->


        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },

    data() {
        return {
            showingNavigationDropdown: false,
            perfilIdUser:  this.$perfilId,
            buscador: ''
        }
    },

    methods: {
        buscarProductos(){
            this.$inertia.get('/buscarProductos/' + this.buscador)
        },
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }
}
</script>
<style scoped>
.container-3{
    width: 300px;
    vertical-align: middle;
    white-space: nowrap;
    position: relative;
}

.container-3 input#search::-webkit-input-placeholder {
    color: #65737e;
}

.container-3 input#search:-moz-placeholder { /* Firefox 18- */
    color: #65737e;
}

.container-3 input#search::-moz-placeholder {  /* Firefox 19+ */
    color: #65737e;
}

.container-3 input#search:-ms-input-placeholder {
    color: #65737e;
}

.container-3 .icon{
    position: absolute;
    top: 50%;
    margin-left: 17px;
    margin-top: 12px;
    z-index: 1;
    color: #2b303b;

    -webkit-transition: all .55s ease;
    -moz-transition: all .55s ease;
    -ms-transition: all .55s ease;
    -o-transition: all .55s ease;
    transition: all .55s ease;
}

.container-3 input#search{
    width: 400px;
    background: white;
    border: none;
    font-size: 10pt;
    float: left;
    color: #2b303b;
    padding-left: 45px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}


@media (min-width: 750px) {
    .buttons2{
        display: none;
    }
    .container-3 input#search{
        width: 400px;
        background: white;
        border: none;
        font-size: 10pt;
        float: left;
        color: #2b303b;
        padding-left: 45px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .box{
        margin-left: 250%;
    }
}
@media (max-width: 749px) {
    .buttons{
        display: none;
    }
    .container-3 input#search{
        width: 250px;
        background: white;
        border: none;
        font-size: 10pt;
        float: left;
        color: #2b303b;
        padding-left: 45px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .box{
        margin-left: 18px;
    }
}

#myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
}

#myBtn:hover {
    background-color: #555;
}


.btn-flotante {
    font-size: 16px; /* Cambiar el tamaño de la tipografia */
    text-transform: uppercase; /* Texto en mayusculas */
    font-weight: bold; /* Fuente en negrita o bold */
    color: #ffffff; /* Color del texto */
    border-radius: 5px; /* Borde del boton */
    letter-spacing: 2px; /* Espacio entre letras */
    background-color: #3d107b; /* Color de fondo */
    padding: 12px 12px; /* Relleno del boton */
    position: fixed;
    bottom: 30px;
    right: 20px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
}
.btn-flotante:hover {
    background-color: #A9CCFF; /* Color de fondo al pasar el cursor */
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
    .btn-flotante {
        font-size: 14px;
        padding: 12px 20px;
        bottom: 20px;
        right: 20px;
    }
}

*,
*:before,
*:after {

}

body {
    background: #333;
    font-family: "Open Sans", Helvetica, Arial, sans-serif;
}

.buttons {
    margin-top: 15px;
    text-align: center;
    border-radius: 30px;
}

.blob-btn {
    z-index: 1;
    position: relative;
    padding: 10px 20px;
    margin-bottom: 30px;
    text-align: center;
    text-transform: uppercase;
    color: #0505a9;
    font-size: 12px;
    font-weight: bold;
    background-color: transparent;
    outline: none;
    border: none;
    transition: color 0.5s;
    cursor: pointer;
    border-radius: 30px;
}
.blob-btn:before {
    content: "";
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border: 2px solid #0505a9;
    border-radius: 30px;
}
.blob-btn:after {
    content: "";
    z-index: -2;
    position: absolute;
    left: 3px;
    top: 3px;
    width: 100%;
    height: 100%;
    transition: all 0.3s 0.2s;
    border-radius: 30px;
}
.blob-btn:hover {
    color: #ffffff;
    border-radius: 30px;
}
.blob-btn:hover:after {
    transition: all 0.3s;
    left: 0;
    top: 0;
    border-radius: 30px;
}
.blob-btn__inner {
    z-index: -1;
    overflow: hidden;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 30px;
    background: #ffffff;
}
.blob-btn__blobs {
    position: relative;
    display: block;
    height: 100%;
    filter: url("#goo");
}
.blob-btn__blob {
    position: absolute;
    top: 2px;
    width: 25%;
    height: 100%;
    background: #0505a9;
    border-radius: 100%;
    transform: translate3d(0, 150%, 0) scale(1.7);
    transition: transform 0.45s;
}
@supports (filter: url("#goo")) {
    .blob-btn__blob {
        transform: translate3d(0, 150%, 0) scale(1.4);
    }
}
.blob-btn__blob:nth-child(1) {
    left: 0%;
    transition-delay: 0s;
}
.blob-btn__blob:nth-child(2) {
    left: 30%;
    transition-delay: 0.08s;
}
.blob-btn__blob:nth-child(3) {
    left: 60%;
    transition-delay: 0.16s;
}
.blob-btn__blob:nth-child(4) {
    left: 90%;
    transition-delay: 0.24s;
}
.blob-btn:hover .blob-btn__blob {
    transform: translateZ(0) scale(1.7);
}
@supports (filter: url("#goo")) {
    .blob-btn:hover .blob-btn__blob {
        transform: translateZ(0) scale(1.4);
    }
}

#search-box {
    position: relative;
    width: 60%;
    margin: 0;
}
#search-form {
    margin-top: 15px;
    height: 32px;
    border: 1px solid #c5c5c5;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 15px;
    background-color: #fff;
    overflow: hidden;
}
#search-text {
    font-size: 14px;
    color: #ddd;
    border-width: 0;
    background: transparent;
}

#search-box input[type="text"] {
    width: 90%;
    padding: 5px 0 12px 1em;
    color: #333;
    outline: none;
}
#search-button {
    margin-top: 15px;
    position: absolute;
    top: 0;
    right: 0;
    height: 32px;
    width: 80px;
    font-size: 14px;
    color: #fff;
    text-align: center;
    line-height: 4px;
    border-width: 0;
    background-color: #3d107b;
    -webkit-border-radius: 0px 5px 5px 0px;
    -moz-border-radius: 0px 5px 5px 0px;
    border-radius: 0px 15px 5px 0px;
    cursor: pointer;
}
</style>
