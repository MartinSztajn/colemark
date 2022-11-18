<template>
    <app-layout>
        <header class="shadow" style="background-color: #A9CCFF">
            <div class="celu">
                <div class="scrollmenu">
                    <a v-for="cat in categorias" :key="cat.id" :href="'/buscarCategoria/' + cat.titulo">{{cat.titulo}}</a>
                </div>
            </div>
            <div class="compu">
                <div style="display: flex; justify-content: center; padding-top: 17px; text-align: center; position: center;">
                    <div v-for="cat in categorias" :key="cat.id" style="text-align: center; position: center;">
                        <button  @click="buscarCategoria(cat.titulo)"  type="submit" class="button"  style="background-color: #3d107b; border-color: white; padding: 0.35rem 0.75rem; float: left; margin-right: 10px; ">
                            {{cat.titulo}}
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div style="margin: 3%">
            <h1 style="text-align: center; font-size: 70px">La Cole Market</h1>
            <h3 style="font-family: 'Brush Script MT', cursive;  text-align: center; font-size: 40px">El mercado mas grande de la comunidad.</h3>

            <div style="margin: 1%; width: 100%; margin-top: 50px">
                <button onclick="location.href='/guardadas'" class="blob-btn" style="background-color: #00b3ee">
                    Guardados
                    <span class="blob-btn__inner">
      <span class="blob-btn__blobs">
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
      </span>
    </span>
                </button>
                <button onclick="location.href='/crearPublicacion'" class="blob-btn">
                    Publicar
                    <span class="blob-btn__inner">
      <span class="blob-btn__blobs"><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span></span>
    </span>
                </button>
                <button onclick="location.href='/publicadas'" class="blob-btn">
                    Publicados
                    <span class="blob-btn__inner">
                      <span class="blob-btn__blobs">
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                      </span>
                    </span>
                </button>
                <button onclick="location.href='/buscarCategoria/Inmuebles'" class="blob-btn">
                    Comprar
                    <span class="blob-btn__inner">
                      <span class="blob-btn__blobs">
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                      </span>
                    </span>
                </button>

                <br/>
            </div>

            <svg style="float: left; margin-right: 15px; margin-top: 95px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="yellow" class="compu bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>

            <h1 class="textoCompu">Productos populares</h1>
            <div class="boxCompu">
                <div class="compu containers" v-for="pub in productos" :key="pub.id" style="float: left; margin-right: 10px">
                    <div style="background-color: #007cc2">
                        <div style="height: 200px; z-index:0;">
                            <img v-if="pub.estado == 1" src="/images/new.png" style="position:absolute; height:60px; width:60px;">
                            <img v-if="pub.estado == 0" src="/images/Uso.png" style="position:absolute; height:60px; width:60px;">
                            <img :src="'/market/' + pub.path2[0].path + '.jpg'" style="min-height: 200px">
                        </div>
                        <div style="z-index:1;">
                            <div class="product-details"  style="background-color: white">
                                <div style="height: 70px">
                                    <h1 style="position: center">{{pub.titulo}} </h1>
                                </div>
                                <p style="font-size: 25px; margin-bottom: 9%">${{pub.precio}} </p>
                                <div style="">
                                    <div style="width: 25%; float: left; margin-left: 15px; margin-right: 10px">
                                        <a style="margin-bottom: 10px" :href="'https://api.whatsapp.com/send?phone=54' + pub.celular + '&text=' + 'Hola%20' + pub.name + ',%20¿Como%20estas?%0ASoy%20' + pub.miNombre + '.%20%0AVi%20tu%20publicacion%20llamada%20' + pub.titulo + '%20en%20CissabMarket%20y%20estoy%20interesado.'" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div style="width: 20%; float: left; margin-left: 5px; margin-right: 10px">
                                        <button  @click="abrirModal(pub, 1)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#7A7A7A" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div style="width: 25%; float: left; margin-left: 5px; margin-right: 5px">
                                        <button  class="btn" v-if="pub.guardar == 0" @click="guardarPublicacion(pub.id, 1)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#7A7A7A" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>                                              </button>
                                        <button  class="btn" v-if="pub.guardar == 1" @click="quitarPublicacion(pub.id, 1)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#FF6767" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <svg  style="float: left; margin-right: 15px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="yellow" class="compu bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            <h1 class="textoCompu" >Inmuebles populares</h1>

            <div class="boxCompu">
                <div class="compu containers" v-for="pub in inmuebles" :key="pub.id"  style="float: left; margin-right: 10px">
                    <div style="background-color: #007cc2">
                        <div style="height: 200px; z-index:0;">
                            <img v-if="pub.estado == 1" src="/images/Venta.png" style="position:absolute; height:60px; width:60px;">
                            <img v-if="pub.estado == 0" src="/images/Alquiler.png" style="position:absolute; height:60px; width:60px;">
                            <img :src="'/market/' + pub.path2[0].path + '.jpg'" style="min-height: 200px">
                        </div>
                        <div style="z-index:1;">
                            <div class="product-details"  style="background-color: white">
                                <div style="height: 70px">
                                    <h1 style="position: center">{{pub.titulo}} </h1>
                                </div>
                                <p style="font-size: 25px; margin-bottom: 9%">${{pub.precio}} </p>
                                <div style="">
                                    <div style="width: 25%; float: left; margin-left: 15px; margin-right: 10px">
                                        <a style="margin-bottom: 10px" :href="'https://api.whatsapp.com/send?phone=54' + pub.celular + '&text=' + 'Hola%20' + pub.name + ',%20¿Como%20estas?%0ASoy%20' + pub.miNombre + '.%20%0AVi%20tu%20publicacion%20llamada%20' + pub.titulo + '%20en%20CissabMarket%20y%20estoy%20interesado.'" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div style="width: 20%; float: left; margin-left: 5px; margin-right: 10px">
                                        <button  @click="abrirModal(pub, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#7A7A7A" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div style="width: 25%; float: left; margin-left: 5px; margin-right: 5px">
                                        <button  class="btn" v-if="pub.guardar == 0" @click="guardarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#7A7A7A" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>                                              </button>
                                        <button  class="btn" v-if="pub.guardar == 1" @click="quitarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#FF6767" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="malito:lacolemarket@gmail.com?subject=Infomación%20Publicidad" target="_top">
                 <img  src="images/Contactanos.jpg" style="width: 100%">
            </a>
            <svg  style="float: left; margin-right: 15px; margin-top: 65px" xmlns="http://www.w3.org/2000/svg" width="40" height="40"fill="currentColor" class="compu bi bi-clock-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
            </svg>
            <h1 class="compu" style="text-align: left; font-size: 40px; margin-top: 60px">Publicaciones más recientes</h1>
            <div class="boxCompu">
                <div class="compu containers" v-for="pub in nuevosProductos" :key="pub.id"  style="float: left; margin-right: 10px">
                    <div style="background-color: #007cc2">
                        <div style="height: 200px; z-index:0;">
                            <img v-if="pub.estado == 1" src="/images/Venta.png" style="position:absolute; height:60px; width:60px;">
                            <img v-if="pub.estado == 0" src="/images/Alquiler.png" style="position:absolute; height:60px; width:60px;">
                            <img :src="'/market/' + pub.path2[0].path + '.jpg'" style="min-height: 200px">
                        </div>
                        <div style="z-index:1;">
                            <div class="product-details"  style="background-color: white">
                                <div style="height: 70px">
                                    <h1 style="position: center">{{pub.titulo}} </h1>
                                </div>
                                <p style="font-size: 25px; margin-bottom: 9%">${{pub.precio}} </p>
                                <div style="">
                                    <div style="width: 25%; float: left; margin-left: 15px; margin-right: 10px">
                                              <a style="margin-bottom: 10px" :href="'https://api.whatsapp.com/send?phone=54' + pub.celular + '&text=' + 'Hola%20' + pub.name + ',%20¿Como%20estas?%0ASoy%20' + pub.miNombre + '.%20%0AVi%20tu%20publicacion%20llamada%20' + pub.titulo + '%20en%20CissabMarket%20y%20estoy%20interesado.'" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                                </svg>
                                            </a>
                                    </div>
                                    <div style="width: 20%; float: left; margin-left: 5px; margin-right: 10px">
                                        <button  @click="abrirModal(pub, 1)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#7A7A7A" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div style="width: 25%; float: left; margin-left: 5px; margin-right: 5px">
                                        <button  class="btn" v-if="pub.guardar == 0" @click="guardarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#7A7A7A" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>                                              </button>
                                        <button  class="btn" v-if="pub.guardar == 1" @click="quitarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#FF6767" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="compu containers" v-for="pub in nuevosInmuebles" :key="pub.id"  style="float: left; margin-right: 10px">
                    <div style="background-color: #007cc2">
                        <div style="height: 200px; z-index:0;">
                            <img v-if="pub.estado == 1" src="/images/Venta.png" style="position:absolute; height:60px; width:60px;">
                            <img v-if="pub.estado == 0" src="/images/Alquiler.png" style="position:absolute; height:60px; width:60px;">
                            <img :src="'/market/' + pub.path2[0].path + '.jpg'" style="min-height: 200px">
                        </div>
                        <div style="z-index:1;">
                            <div class="product-details"  style="background-color: white">
                                <div style="height: 70px">
                                    <h1 style="position: center">{{pub.titulo}} </h1>
                                </div>
                                <p style="font-size: 25px; margin-bottom: 9%">${{pub.precio}} </p>
                                <div style="">
                                    <div style="width: 25%; float: left; margin-left: 15px; margin-right: 10px">
                                        <a style="margin-bottom: 10px" :href="'https://api.whatsapp.com/send?phone=54' + pub.celular + '&text=' + 'Hola%20' + pub.name + ',%20¿Como%20estas?%0ASoy%20' + pub.miNombre + '.%20%0AVi%20tu%20publicacion%20llamada%20' + pub.titulo + '%20en%20CissabMarket%20y%20estoy%20interesado.'" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div style="width: 20%; float: left; margin-left: 5px; margin-right: 10px">
                                        <button  @click="abrirModal(pub, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#7A7A7A" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div style="width: 25%; float: left; margin-left: 5px; margin-right: 5px">
                                        <button  class="btn" v-if="pub.guardar == 0" @click="guardarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#7A7A7A" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>                                              </button>
                                        <button  class="btn" v-if="pub.guardar == 1" @click="quitarPublicacion(pub.id, 2)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="#FF6767" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16">
                                                <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <footer class="site-footer" style="width: 100%; float: right; margin-top: 50px">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <h6>Nosotros</h6>
                        <p class="text-justify" style="margin: 20px"></p>Somos el mercado de la comunidad. Podes vender, comprar todo lo que necesites en un ambiente de confianza, calidad y seguridad.     </div>

                    <div class="col-xs-6 col-md-7">
                        <h6 style="margin-bottom: 20px">Categorias</h6>
                        <ul class="footer-links" v-for="cat in categorias" :key="cat.id">
                            <li><button @click="buscarCategoria(cat.titulo)"> {{cat.titulo}}</button></li>
                        </ul>
                    </div>
                    <hr style="width: 90%; margin-left:5%; margin-bottom:20px; margin-top:20px;">
                    <div class="col-xs-12 col-md-12">
                        <p style="text-align: center">Copyright &copy; 2022 La Cole Market S.R.L</p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="modal  fade"  id="Modal1" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 3%">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <div>
                            <h1 style="text-align: center; font-size: 40px; margin-bottom: 20px"><u>Descripción del producto:</u></h1>
                            <p style="text-align: center; font-size: 25px">{{pub.descripcion}}</p>
                        </div>
                        <button  @click="cambiarFotos()"  style="width: 50%; margin-left: 25%; background-color: #A9CCFF; font-size: 20px; border-radius: 5px; margin-top: 40px;  margin-bottom: 20px">Ver más imágenes</button>
                        <div v-for="(foto, key) in pub.path2" v-if="verFotos">
                            <img :src="'/market/' + foto.path + '.jpg'" style="width: 70%; margin-left:15%;    border: 5px solid black;   border-radius: 25px; margin-bottom: 15px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal  fade"  id="Modal2" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-top: 3%">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <div>
                            <h1 style="text-align: center; font-size: 40px; margin-bottom: 20px"><u>Descripción:</u></h1>
                            <p style="text-align: center; font-size: 25px; margin-bottom: 10px">{{pub.descripcion}}</p>
                            <p class="informacion"> ● <b>Sector:</b> {{pub.nomSector}}</p>
                            <p class="informacion"> ● <b>Lote:</b> {{pub.lote}}</p>
                            <p class="informacion"> ● <b>Dormitorios:</b> {{pub.dormitorios}}</p>
                            <p class="informacion"> ● <b>Superficie Total:</b> {{pub.superficie_total}} m2</p>
                            <p class="informacion"> ● <b>Pisos:</b> {{pub.pisos}}</p>
                            <p class="informacion"> ● <b>Baños:</b> {{pub.baños}}</p>
                            <p class="informacion"> ● <b>Ambientes:</b> {{pub.ambientes}}</p>
                            <p class="informacion" v-if="pub.jardin == 1"> ● Tiene Jardin</p>
                            <p class="informacion" v-if="pub.pileta == 1"> ● Tiene Pileta</p>
                            <p class="informacion" v-if="pub.parilla == 1"> ● Tiene Parilla</p>

                        </div>
                        <button  @click="cambiarFotos()"  style="width: 50%; margin-left: 25%; background-color: #A9CCFF; font-size: 20px; border-radius: 5px; margin-top: 40px;  margin-bottom: 20px">Ver más imágenes</button>
                        <div v-for="(foto, key) in pub.path2" v-if="verFotos">
                            <img :src="'/market/' + foto.path + '.jpg'" style="width: 70%; margin-left:15%;    border: 5px solid black;   border-radius: 25px; margin-bottom: 15px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal  fade"  id="Modal3" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style=" margin-top: 3%">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <div v-for="(pre,key) in fotos">
                            <img :src="'/market/' + pre.path + '.jpg'"  style="width: 90%; position: center; margin: 5%; border:10px outset #5B5B5B;">
                        </div>
                        <button  @click="cambiarFotos()"  style="width: 50%; margin-left: 25%; background-color: #A9CCFF; font-size: 20px; border-radius: 5px; margin-top: 40px;  margin-bottom: 20px">Ver más imágenes</button>
                        <div v-for="(foto, key) in pub.path2" v-if="verFotos">
                            <img :src="'/market/' + foto.path + '.jpg'" style="width: 70%; margin-left:15%;    border: 5px solid black;   border-radius: 25px; margin-bottom: 15px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Button from "@/Jetstream/Button";

export default {
    name: "Index",
    props: ['categorias','productos','inmuebles','nuevosProductos','nuevosInmuebles'],
    components: {
        Button,
        AppLayout,
        Welcome
    },
    data()
    {
        return{
            listo: 0,
            titulo: '',
            buscador: '',
            verFotos: 0,

            pub: [],
            form:{
            }
        }
    },
    methods:
        {
            buscarCategoria(titulo)
            {
                this.$inertia.get('/buscarCategoria/' + titulo);
            },
            abrirModal($pub, $num){
                this.verFotos = 0;
                this.pub = $pub;

                if ($num == 1){
                    $('#Modal1').modal();
                }
                if ($num == 2){
                    $('#Modal2').modal();
                }
                if($num == 3){
                    $('#Modal3').modal();
                }
            },
            cambiarFotos(){
                if(this.verFotos == 0){
                    this.verFotos = 1;
                }
                else{
                    this.verFotos = 0;
                }
            },
            guardarPublicacion($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;
                this.$inertia.post('/guardarPublicacion', this.form);
            },
            quitarPublicacion($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;
                this.$inertia.post('/quitarPublicacion', this.form);
            },
        },
}
</script>


<style scoped>
.row{
    margin-left: 0px;
    margin-right: 0px;
    text-align: center;
}
.site-footer
{
    background-color:#26272b;
    padding:20px 0 20px;
    font-size:15px;
    line-height:20px;
    color:#737373;
}
.site-footer hr
{
    border-top-color:#bbb;
    opacity:0.5
}
.site-footer hr.small
{
    margin:20px 0
}
.site-footer h6
{
    color:#fff;
    font-size: 19px;
    margin-bottom: 10px;
    text-transform:uppercase;
    margin-top:5px;
    letter-spacing:2px
}
.site-footer a
{
    color:#737373;
}
.site-footer a:hover
{
    color:#3366cc;
    text-decoration:none;
}
.footer-links
{
    width: 20%;
    float: left;
    padding-left:0;
    list-style:none
}
.footer-links li
{
    display:block
}
.footer-links a
{
    color:#737373
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
    color:#3366cc;
    text-decoration:none;
}
.footer-links.inline li
{
    display:inline-block
}
.site-footer .social-icons
{
    text-align:right
}
.site-footer .social-icons a
{
    width:40px;
    height:40px;
    line-height:40px;
    margin-left:6px;
    margin-right:0;
    border-radius:100%;
    background-color:#33353d
}
.copyright-text
{
    margin:0
}
@media (max-width:991px)
{
    .site-footer [class^=col-]
    {
        margin-bottom:30px
    }
}
@media (max-width:767px)
{
    .site-footer
    {
        padding-bottom:0
    }
    .site-footer .copyright-text,.site-footer .social-icons
    {
        text-align:center
    }
}
.social-icons
{
    padding-left:0;
    margin-bottom:0;
    list-style:none
}
.social-icons li
{
    display:inline-block;
    margin-bottom:4px
}
.social-icons li.title
{
    margin-right:15px;
    text-transform:uppercase;
    color:#96a2b2;
    font-weight:700;
    font-size:13px
}
.social-icons a{
    background-color:#eceeef;
    color:#818a91;
    font-size:16px;
    display:inline-block;
    line-height:44px;
    width:44px;
    height:44px;
    text-align:center;
    margin-right:8px;
    border-radius:100%;
    -webkit-transition:all .2s linear;
    -o-transition:all .2s linear;
    transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
    color:#fff;
    background-color:#29aafe
}
.social-icons.size-sm a
{
    line-height:34px;
    height:34px;
    width:34px;
    font-size:14px
}
.social-icons a.facebook:hover
{
    background-color:#3b5998
}
.social-icons a.twitter:hover
{
    background-color:#00aced
}
.social-icons a.linkedin:hover
{
    background-color:#007bb6
}
.social-icons a.dribbble:hover
{
    background-color:#ea4c89
}
@media (max-width:767px)
{
    .social-icons li.title
    {
        display:block;
        margin-right:0;
        font-weight:600
    }
}





























body{
    font-family: "Open Sans", Helvetica, Arial, sans-serif;
}
div.scroll {
    margin: 4px 4px;
    padding: 4px;
    background-color: #08c708;
    width: 300px;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}

.button {
    display: inline-block;
    padding: 15px 25px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    border-radius: 7px;
    box-shadow: 0 6px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
    background-color: #3e8e41;
    box-shadow: 0 6px #666;
    transform: translateY(4px);
}



/* fonts  */
@import url('https://fonts.googleapis.com/css?family=Abel|Aguafina+Script|Artifika|Athiti|Condiment|Dosis|Droid+Serif|Farsan|Gurajada|Josefin+Sans|Lato|Lora|Merriweather|Noto+Serif|Open+Sans+Condensed:300|Playfair+Display|Rasa|Sahitya|Share+Tech|Text+Me+One|Titillium+Web');

body {
    background: #DFC2F2;
    background-image: linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%);
    background-attachment: fixed;
    background-size: cover;
}

/* 	Product details  */
.product-details {
    position: relative;
    text-align: left;
    overflow: hidden;
    padding: -54px;
    height: 100%;
    float: left;
    width: 40%;

}

/* 	Product Name */
.container .product-details h1{
    font-family: 'Old Standard TT', serif;
    display: inline-block;
    position: relative;
    font-size: 34px;
    color: #344055;
    margin: 0;

}




/*Product Rating  */
.hint-star {
    display: inline-block;
    margin-left: 0.5em;
    color: gold;
    width: 50%;
}


/* The most important information about the product */
.container .product-details > p {
    font-family: 'Farsan', cursive;
    text-align: center;
    font-size: 20px;
    color: #7d7d7d;

}

/* control */

.control{
    position: absolute;
    bottom: 2%;
    left: 10%;

}
/* the Button */
.btn {
    transform: translateY(0px);
    transition: 0.3s linear;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    border: none;
    color: #eee;
    padding: 0;
    margin: 0;

}

.btn:hover{transform: translateY(-4px);}

.btn span {
    font-family: 'Farsan', cursive;
    transition: transform 0.3s;
    display: inline-block;
    padding: 10px 20px;
    font-size: 1.2em;
    margin:0;

}


.btn .price {
    transform: translateX(-10%); padding-right: 15px;
}

/* the Icon */
.btn .shopping-cart {
    transform: translateX(-100%);
    position: absolute;
    background: #333;
    z-index: 1;
    left: 0;
    top: 0;
}

/* buy */
.btn .buy {z-index: 3; font-weight: bolder;}

.btn:hover .price {transform: translateX(-110%);}

.btn:hover .shopping-cart {transform: translateX(0%);}



/* product image  */
.product-image {
    transition: all 0.3s ease-out;
    display: inline-block;
    position: relative;
    overflow: hidden;
    height: 350px;
    width: 60%;
    display: inline-block;
}

.container img {width: 100%;height: 100%;}

.info {
    background: rgba(27, 26, 26, 0.9);
    font-family: 'Farsan', cursive;
    transition: all 0.3s ease-out;
    transform: translateX(-100%);
    position: absolute;
    line-height: 1.9;
    text-align: left;
    font-size: 120%;
    cursor: no-drop;
    color: #FFF;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.info h2 {text-align: center}
.product-image:hover .info{transform: translateX(0);}

.info ul li{transition: 0.3s ease;}
.info ul li:hover{transform: translateX(50px) scale(1.3);}

.product-image:hover img {transition: all 0.3s ease-out;}
.product-image:hover img {transform: scale(1.2, 1.2);}


galeria {
    height: calc( 300px + 3em);
    width: 260px;
    margin:1em auto;
    border: 1px solid #555;
    position: relative;
}

.galeria img {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 3s;
}

.galeria input[type=radio] {
    position: relative;
    bottom: calc(-300px - 1.5em);
    left: .5em;
}

.galeria input[type=radio]:nth-of-type(1):checked ~ img:nth-of-type(1) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(2):checked ~ img:nth-of-type(2) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(3):checked ~ img:nth-of-type(3) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(4):checked ~ img:nth-of-type(4) {
    opacity: 1;
}



@media (min-width: 750px) {
    .boxCompu{
        width: 100%;margin-bottom: 10%;background-color: white;box-shadow: rgb(128 128 128) 10px 10px 10px 10px;margin-top: 50px;height: 500px; display: flex; justify-content: center; padding-top: 17px; text-align: center; position: center;
    }
    .textoCompu{
        text-align: left; font-size: 40px; margin-top: 105px;
    }
    .shadow{
        height: 80px;
    }
    .celu{
        display: none;
    }
    .videoClass{
        width: 47%;
    }
    .fotoClass{
        width: 320px;
        height: 320px;
    }
    .container{
        box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
        background: rgba(255, 255, 255, 0.90);
        text-align: center;
        border-radius: 5px;
        overflow: hidden;
        margin: 20px;
        height: 350px;
        width: 450px;
    }
    .blob-btn {
        z-index: 1;
        position: relative;
        padding: 10px 20px;
        text-align: center;
        text-transform: uppercase;
        color: #0505a9;
        font-size: 20px;
        font-weight: bold;
        background-color: transparent;
        outline: none;
        border: none;
        transition: color 0.5s;
        cursor: pointer;
        border-radius: 30px;
        margin: 1%;
        width: 22%;
        height: 150px;
    }

    .example::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }


    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }
}
@media (max-width: 749px) {
    .boxCompu{
        display: none;
    }
    .compu{
        display: none;
    }
    .textoCompu{
        display: none;
    }
    .blob-btn {
        z-index: 1;
        position: relative;
        padding: 10px 20px;
        margin-bottom: 10px;
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
        width: 45%;
        height: 150px;
    }
    div.scrollmenu {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        background-color: #777;
    }
    .videoClass{
        width: 90%;
        margin-left: 5%;
    }
    .fotoClass{
        margin-left: 10px;
        width: 44%;
        float: left;
    }
    .container{
        box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
        background: rgba(255, 255, 255, 0.90);
        text-align: center;
        border-radius: 5px;
        overflow: hidden;
        margin: 20px;
        height: 300px;
        width: 350px;
    }
}

.buttons {
    margin-top: 15px;
    text-align: center;
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
    background: #A9CCFF;
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


.containers{
    box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
    background: rgba(255, 255, 255, 0.90);
    text-align: center;
    border-radius: 5px;
    overflow: hidden;
    margin: 20px;
    height: 400px;
    width: 270px;

}



/* 	Product details  */
.product-details {
    position: relative;
    text-align: left;
    overflow: hidden;
    padding: -54px;
    height: 350px;
    float: left;
    width: 100%;

}

/* 	Product Name */
.containers h1{
    font-family: 'Old Standard TT', serif;
    position: relative;
    font-size: 25px;
    color: black;
    padding: 5px;
    text-align: center;
}




/*Product Rating  */
.hint-star {
    display: inline-block;
    margin-left: 0.5em;
    color: gold;
    width: 50%;
}


/* The most important information about the product */
.containers .product-details > p {
    font-family: 'Farsan', cursive;
    text-align: center;
    font-size: 20px;
    color: #7d7d7d;

}

/* control */

.control{
    position: absolute;
    bottom: 2%;
    left: 22.5%;

}
/* the Button */
.btn {
    transform: translateY(0px);
    transition: 0.3s linear;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    border: none;
    color: #eee;
    padding: 0;
    margin: 0;

}

.btn:hover{transform: translateY(-4px);}

.btn span {
    font-family: 'Farsan', cursive;
    transition: transform 0.3s;
    display: inline-block;
    padding: 10px 20px;
    font-size: 1.2em;
    margin:0;

}


.btn .price {
    transform: translateX(-10%); padding-right: 15px;
}

/* the Icon */
.btn .shopping-cart {
    transform: translateX(-100%);
    position: absolute;
    background: #333;
    z-index: 1;
    left: 0;
    top: 0;
}

/* buy */
.btn .buy {z-index: 3; font-weight: bolder;}

.btn:hover .price {transform: translateX(-110%);}

.btn:hover .shopping-cart {transform: translateX(0%);}



/* product image  */
.product-image {
    transition: all 0.3s ease-out;
    display: inline-block;
    position: relative;
    overflow: hidden;
    height: 350px;
    width: 100%;
    display: inline-block;
}

.containers img {width: 100%;}

.info {
    background: #3d107b;
    font-family: 'Farsan', cursive;
    position: absolute;
    line-height: 1.9;
    text-align: left;
    font-size: 120%;
    color: #FFF;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.info h2 {text-align: center}
.product-image:hover .info{transform: translateX(0);}

.info ul li{transition: 0.3s ease;}
.info ul li:hover{transform: translateX(50px) scale(1.3);}

.product-image:hover img {transition: all 0.3s ease-out;}
.product-image:hover img {transform: scale(1.2, 1.2);}



.galeria img {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 3s;
}

.galeria input[type=radio] {
    position: relative;
    bottom: calc(-300px - 1.5em);
    left: .5em;
}

.galeria input[type=radio]:nth-of-type(1):checked ~ img:nth-of-type(1) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(2):checked ~ img:nth-of-type(2) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(3):checked ~ img:nth-of-type(3) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(4):checked ~ img:nth-of-type(4) {
    opacity: 1;
}

</style>
