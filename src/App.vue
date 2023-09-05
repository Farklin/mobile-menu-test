<template>
  <div class="menu-hamburger">
    <a id="hamburger" :class="{ active: openMenu }" @click="openMenu = !openMenu">
      <div></div>
      <div></div>
      <div></div>
    </a>
  </div>
  <div :class="{ active: openMenu }" class="menu">
    <Menu v-if="!load" :menu-items="menuItems" :show-back-button="false" />
  </div>
</template>

<script>
import Menu from "@/components/Menu.vue";

export default {
  components: {
    Menu,
  },
  mounted() {
    this.load = true; 
    fetch("https://api.v-poisk.ru/api/getMenu", {
      method: "GET",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Конвертируем ответ в JSON
      })
      .then((data) => {
        this.menuItems = data; // Присваиваем данные переменной
        this.load = false; 
        console.log(data);
      })
      .catch((error) => {
        console.error(error);
      });
  },
  data() {
    return {
      openMenu: false,
      showSubMenu: false,
      currentSubMenu: null,
      load: false, 
      menuItems: [],
    };
  },
};
</script>

<style scoped>
.menu {
  position: static;
  top: 0;
  display: none;
}
.menu.active {
  display: block;
}
.menu-hamburger {
  position: static;
  height: 40px;
}

#hamburger {
  position: absolute;
  right: 1rem;
  width: 30px; /* Ширина кнопки */
  height: 19px; /* Высота кнопки */
  cursor: pointer; /* Курсор при наведении */
  display: flex; /* Отображение как flex-контейнер */
  flex-direction: column; /* Расположение элементов в колонку */
  justify-content: space-between; /* Равномерное распределение по вертикали */
  background-color: transparent; /* Прозрачный фон */
  border: none; /* Убираем границу */
  padding: 0; /* Убираем внутренний отступ */
}

#hamburger div {
  width: 100%; /* Ширина полоски */
  height: 3px; /* Высота полоски */
  background-color: #111; /* Цвет полоски */
  transition: 0.4s; /* Плавное изменение при анимации */
}

/* Анимация при клике на гамбургер */
#hamburger.active div:nth-child(1) {
  transform: translateY(8px) rotate(45deg);
}

#hamburger.active div:nth-child(2) {
  opacity: 0;
}

#hamburger.active div:nth-child(3) {
  transform: translateY(-8px) rotate(-45deg);
}
</style>
