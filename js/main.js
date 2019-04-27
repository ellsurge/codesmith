

// creating a vue intance for the header data and style list

// nav bat component
Vue.component('nav-bar',{
    props:[],
    template:
})
var head = new Vue({
    el:"#head-style",
    data:{
        title: "optus",
        theme: "css/themes/light_theme.css",
        styles: [
            'css/utilities/media.css',
            'css/utilities/box-shadows.css',
            'css/main.css'
        ]
    }
})

var browser_main = new Vue({el: "#body"})


