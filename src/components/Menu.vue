<template>
  <div>
  
    <button class="back back-arrow" v-if="showBackButton" @click="goBack">{{previewItem.title}}</button>
    <ul :class="{active: active}">
      <li v-for="item in currentMenu" :key="item.title">
        <div class="menu-link" :class="{next: item.children}"><button @click="goLink(item)" :class="{'slide-in': !showSubMenu, 'slide-out': showSubMenu}">{{ item.title }}</button><span class="menu-item-name" :class="{arrow: item.children}" @click="navigate(item)">  </span></div>
        <Menu v-if="item.children" :menu-items="item.children"></Menu>
      </li>
    </ul>
  </div>
</template>

<script>
import Menu from "@/components/Menu.vue"; // Используйте имя вашего компонента SubMenu
export default {
  props: {
    menuItems: Array,
  },
  data() {
    return {
      currentMenu: this.menuItems,
      showBackButton: false,
      currentSubMenu: [],
      active: false,
      previewItem: {}
    };
  },
  mounted(){

  }, 
  methods: {
    navigate(item) {
      if (item.children) {
        this.showBackButton = true;
        this.currentSubMenu.push(this.currentMenu);
        this.currentMenu = item.children;
        this.active = true;
        this.previewItem = item; 
      } else {
        window.location.href = item.url;
        this.showBackButton = false;
      }
      
    },
    goLink(item){
      window.location.href = item.url;
    }, 
    goBack() {
      if (this.currentSubMenu.length > 0) {
        this.currentMenu = this.currentSubMenu.pop();
        if(this.currentSubMenu.length == 0) {
            this.showBackButton = false;
        }
         
        this.showSubMenu = false;
      }
     
    },
  },
};
</script>

<style scoped>
.back-arrow{
  position: relative;
}
.back-arrow:before, 
.back-arrow:after {
    top: 50%; 
    border-right: 2px solid;
    content: '';
    display: block;
    height: 8px;
    margin-top: -6px;
    position: absolute;
    left: 10px;
    width: 0;
     transform:rotate(180deg);
}

.back-arrow:before {
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}

.back-arrow:after {
    margin-top: -1px;
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
}

li ul{
    display: none; 
}
li{
    list-style: none; 
}

li button{
    border: none; 

    background: transparent; 
    padding: 7px 7px; 
    font-size:1.2rem; 
}

.menu-link{
  width: 100%; 
  display: flex;
  border-bottom: 1px solid #eee; 
  justify-content: left;
  padding-left: 1rem; 
}
.menu-link span{
  width: 30px; 
  display: block; 
  position: relative;
}


button.back{
    border: none; 
    color: #9f9f9f; 
    background: #f7f7f7; 
    padding: 7px 0px; 
    width: 100%;
    font-size:1.2rem;  
    margin-bottom: 1rem; 
}

.arrow:before, .arrow:after {
    border-right: 2px solid;
    content: '';
    display: block;
    height: 8px;
    margin-top: -6px;
    position: absolute;
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
    right: 10px;
    top: 50%;
    width: 0;
}

.arrow:after {
    margin-top: -1px;
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}

.slide-in {
  animation: slideIn 0.3s forwards;
}

.slide-out {
  animation: slideOut 0.3s forwards;
}

@keyframes slideIn {
  0% {
    opacity: 0;
    transform: translateX(-40px);
    transition: 1s; 
  }
  100% {
    opacity: 1;
    transform: translateX(0);
    transition: 1s; 
  }
}

@keyframes slideOut {
  0% {
    opacity: 1;
    transform: translateX(0);
    transition: 1s; 
  }
  100% {
    opacity: 0;
    transform: translateX(-40px);
    transition: 1s; 
  }
}
</style>
