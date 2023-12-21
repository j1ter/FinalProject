// Функция scrollHeader отвечает за изменение фона заголовка при прокрутке страницы
function scrollHeader() {
  const header = document.getElementById("header");

  // Если значение вертикальной прокрутки больше или равно 50 пикселей
  if (window.scrollY >= 50) {
    // Добавляем класс "scroll-header" к элементу заголовка
    header.classList.add("scroll-header");
  } else {
    // Иначе, если значение вертикальной прокрутки меньше 50 пикселей
    // Удаляем класс "scroll-header" из элемента заголовка
    header.classList.remove("scroll-header");
  }
}

// Добавляем слушатель события прокрутки страницы
window.addEventListener("scroll", scrollHeader);

/*=============== SWIPER POPULAR ===============*/
// Создание нового экземпляра Swiper с классом "popular__container"
var swiperPopular = new Swiper(".popular__container", {
  // Опции слайдера
  spaceBetween: 32, // Расстояние между слайдами (в пикселях)
  grabCursor: true, // Изменение курсора при наведении на слайд
  centeredSlides: true, // Выравнивание слайдов по центру
  slidesPerView: "auto", // Количество видимых слайдов (автоопределение)
  loop: true, // Зацикливание слайдера
  navigation: {
    // Навигация (стрелки переключения слайдов)
    nextEl: ".swiper-button-next", // Селектор элемента "Next" (следующий слайд)
    prevEl: ".swiper-button-prev", // Селектор элемента "Prev" (предыдущий слайд)
  },
});

// Функция valueAccordion отвечает за работу аккордеона с разверткой контента при клике
const valueAccordion = () => {
  // Получаем все элементы аккордеона с помощью селектора ".value__accordion-item"
  const accordionItems = document.querySelectorAll(".value__accordion-item");

  // Для каждого элемента аккордеона
  accordionItems.forEach((item) => {
    // Получаем заголовок аккордеона внутри элемента
    const accordionHeader = item.querySelector(".value__accordion-header");

    // Добавляем слушатель события "click" на заголовок аккордеона
    accordionHeader.addEventListener("click", () => {
      // Находим открытый элемент аккордеона, если такой есть
      const openItem = document.querySelector(".accordion-open");

      // Вызываем функцию toggleItem для текущего элемента аккордеона
      toggleItem(item);

      // Если есть открытый элемент и он не равен текущему элементу,
      // вызываем функцию toggleItem для открытого элемента
      if (openItem && openItem !== item) {
        toggleItem(openItem);
      }
    });
  });
};

// Функция toggleItem отвечает за переключение состояния элемента аккордеона
const toggleItem = (item) => {
  // Находим контент аккордеона внутри элемента
  const accordionContent = item.querySelector(".value__accordion-content");

  // Если элемент имеет класс "accordion-open"
  if (item.classList.contains("accordion-open")) {
    // Удаляем стили у контента аккордеона и удаляем класс "accordion-open"
    accordionContent.removeAttribute("style");
    item.classList.remove("accordion-open");
  } else {
    // Иначе, если элемент не имеет класса "accordion-open"
    // Задаем высоту контента аккордеона равной его полной высоте и добавляем класс "accordion-open"
    accordionContent.style.height = accordionContent.scrollHeight + "px";
    item.classList.add("accordion-open");
  }
};

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
// Получаем все секции с атрибутом "id"
const sections = document.querySelectorAll("section[id]");

// Функция scrollActive вызывается при прокрутке страницы
function scrollActive() {
  // Получаем текущую прокрутку страницы по вертикали
  const scrollY = window.pageYOffset;

  // Для каждой секции
  sections.forEach((current) => {
    // Получаем высоту секции, верхнюю позицию секции и значение атрибута "id" секции
    const sectionHeight = current.offsetHeight,
      sectionTop = current.offsetTop - 58,
      sectionId = current.getAttribute("id");

    // Если прокрутка страницы находится в пределах секции
    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      // Добавляем класс "active-link" к ссылке в меню, которая содержит значение атрибута "href" соответствующей секции
      document
        .querySelector(".nav__menu a[href*=" + sectionId + "]")
        .classList.add("active-link");
    } else {
      // Иначе, если прокрутка страницы не находится в пределах секции
      // Удаляем класс "active-link" у ссылки в меню, которая содержит значение атрибута "href" соответствующей секции
      document
        .querySelector(".nav__menu a[href*=" + sectionId + "]")
        .classList.remove("active-link");
    }
  });
}

// Добавляем слушатель события "scroll" на окно браузера
window.addEventListener("scroll", scrollActive);

/*=============== SHOW SCROLL UP ===============*/
const scrollUp = () => {
  const scrollUp = document.getElementById("scroll-up");
  //Когда прокрутка превышает высоту области просмотра 350, добавьте класс show-scroll в тег a с классом scrollup
  this.scrollY >= 350
    ? scrollUp.classList.add("show-scroll")
    : scrollUp.classList.remove("show-scroll");
};
window.addEventListener("scroll", scrollUp);

/*=============== DARK LIGHT THEME ===============*/
const themeButton = document.getElementById("theme-button");
const darkTheme = "dark-theme";
const iconTheme = "bx-sun";

// Ранее выбранная тема (если выбрана пользователем)
const selectedTheme = localStorage.getItem("selected-theme");
const selectedIcon = () => localStorage.getItem("selected-icon");

// Мы получаем текущую тему интерфейса, проверяя класс темной темы
const getCurrentTheme = () =>
  document.body.classList.contains(darkTheme) ? "dark" : "light";
const getCurrentIcon = () =>
  themeButton.classList.contains(iconTheme) ? "bx bx-moon" : "bx bx-sun";

// Мы проверяем, выбрал ли пользователь ранее тему
if (selectedTheme) {
  // Если проверка выполнена, мы спрашиваем, в чем проблема, чтобы узнать, активировали мы или деактивировали темную
  document.body.classList[selectedTheme === "dark" ? "add" : "remove"](
    darkTheme
  );
  themeButton.classList[selectedIcon === "bx bx-moon" ? "add" : "remove"](
    iconTheme
  );
}

document.addEventListener("DOMContentLoaded", function () {
  const themeButton = document.getElementById("theme-button");

  if (themeButton) {
    themeButton.addEventListener("click", () => {
      // Добавить или удалить темную тему / тему значков
      document.body.classList.toggle(darkTheme);
      themeButton.classList.toggle(iconTheme);
      // Сохраняем тему и текущую иконку, которую выбрал пользователь
      localStorage.setItem("selected-theme", getCurrentTheme());
      localStorage.setItem("selected-icon", getCurrentIcon());
    });
  }
});

/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
  origin: "top",
  distance: "60px",
  duration: 2500,
  delay: 400,
  //reset: true
});

sr.reveal(
  ".home__title, .popular__container, .subscribe__container, .footer__container"
);
sr.reveal(".home__description, .footer__info", { delay: 500 });
sr.reveal(".home__search", { delay: 600 });
sr.reveal(".home__value", { delay: 700 });
sr.reveal(".home__images", { delay: 800, origin: "bottom" });
sr.reveal(".logos__img", { interval: 100 });
sr.reveal(".value__images, .contact__content", { origin: "left" });
sr.reveal(".value__content, .contact__images", { origin: "right" });
