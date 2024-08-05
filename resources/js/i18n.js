import { createI18n } from 'vue-i18n';
import spanish from './translate/es.js';

const messages = {
    es: spanish,
    // Agrega otros idiomas según sea necesario
};

const i18n = createI18n({
    locale: 'es', // idioma por defecto
    messages,
});

export default i18n;
