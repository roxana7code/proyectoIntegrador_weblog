

// Diccionario de traducciones para textos generales
const translations = {
  es: {
    inicio: "Inicio",
    tutoriales: "Tutoriales",
    nosotros: "Nosotros",
    cerrarSesion: "Cerrar sesión",
    bienvenido: "Bienvenido",
    publicaciones: "Publicaciones Recientes",
    leerMas: "Leer más",
    pasoTitulo: "Pasos para una alimentación saludable",
    paso1: "Planificas tus comidas",
    paso1desc: "Organiza tus comidas saludables para asegurar una dieta balanceada",
    paso2: "Incluye más frutas y verduras",
    paso2desc: "Aumenta el consumo de alimentos frescos y naturales en tu dieta diaria",
    paso3: "Hidrátate adecuadamente",
    paso3desc: "Mantén tu cuerpo hidratado bebiendo suficiente agua a lo largo del día"
  },
  en: {
    inicio: "Home",
    tutoriales: "Tutorials",
    nosotros: "About Us",
    cerrarSesion: "Log out",
    bienvenido: "Welcome",
    publicaciones: "Recent Posts",
    leerMas: "Read more",
    pasoTitulo: "Steps to a healthy diet",
    paso1: "Plan your meals",
    paso1desc: "Organize your meals to ensure a balanced diet",
    paso2: "Include more fruits and vegetables",
    paso2desc: "Increase the intake of fresh and natural foods in your daily diet",
    paso3: "Stay hydrated",
    paso3desc: "Keep your body hydrated by drinking enough water throughout the day"
  }
};

const traducciones = {
    es: {
        bienvenida: "Bienvenido al panel del admin",
        crear_publicacion: "Crear Publicación",
        titulo: "Título de la publicación",
        autor: "Autor de la publicación",
        contenido: "Contenido de la publicación",
        resumen: "Resumen de la publicación",
        fecha: "Fecha",
        agregar: "Agregar publicación",
        lista: "Lista de publicaciones",
        editar: "Editar",
        eliminar: "Eliminar",
        ver: "Ver",
        inicio: "Inicio",
        vista_previa: "Vista previa",
        cerrar_sesion: "Cerrar sesión",
        panel_admin: "Panel del admin"
    },
    en: {
        bienvenida: "Welcome to the admin panel",
        crear_publicacion: "Create Post",
        titulo: "Post Title",
        autor: "Post Author",
        contenido: "Post Content",
        resumen: "Post Summary",
        fecha: "Date",
        agregar: "Add Post",
        lista: "Post List",
        editar: "Edit",
        eliminar: "Delete",
        ver: "View",
        inicio: "Home",
        vista_previa: "Preview",
        cerrar_sesion: "Log Out",
        panel_admin: "Admin Panel"
    }
};


// Cambiar el idioma y guardar en localStorage
function toggleLanguage() {
  const currentLang = localStorage.getItem('language') || 'es';
  const newLang = currentLang === 'es' ? 'en' : 'es';
  const flagIcon = document.getElementById('flag-icon');

  flagIcon.src = newLang === 'es' ? 'img/esp.png' : 'img/eng.png';
  localStorage.setItem('language', newLang);
  applyLanguage(newLang);
}

// Aplicar el idioma cargado desde localStorage
function loadLanguage() {
  const savedLang = localStorage.getItem('language') || 'es';
  const flagIcon = document.getElementById('flag-icon');
  flagIcon.src = savedLang === 'en' ? 'img/eng.png' : 'img/esp.png';
  applyLanguage(savedLang);
}

// Función que traduce los textos según el idioma
function applyLanguage(lang) {
  // 1. Para elementos con data-es / data-en
  const elementos = document.querySelectorAll('[data-es]');
  elementos.forEach(el => {
    const texto = el.getAttribute(`data-${lang}`);
    if (texto !== null) {
      el.textContent = texto;
    }
      // 2. Para inputs con data-placeholder-es / data-placeholder-en
  const inputs = document.querySelectorAll('input[data-placeholder-es]');
  inputs.forEach(input => {
    const placeholder = input.getAttribute(`data-placeholder-${lang}`);
    if (placeholder) {
      input.placeholder = placeholder;
    }
  });

  });

  // 2. Para elementos con clases lang-[clave]
  Object.keys(translations[lang]).forEach(key => {
    const elements = document.querySelectorAll(`.lang-${key}`);
    elements.forEach(element => {
      element.textContent = translations[lang][key];
    });
  });

  console.log(`Idioma cambiado a: ${lang}`);
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', loadLanguage);
const elementos = document.querySelectorAll('[data-es]');
