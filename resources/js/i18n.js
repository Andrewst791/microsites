import { createI18n } from 'vue-i18n';

// Importar traducciones desde Laravel (esto puede variar según cómo decidas cargar las traducciones)
const messages = {
    es: {
        close: 'Cerrar',
        save: 'Guardar',
        cancel: 'Cancelar',

        //Paginate
        previous: 'Anterior',
        next: 'Siguiente',
        search: 'Buscar',

        //Modules
        categories: 'Categorias',
        category: 'Categoría | Categorias',
        sites: 'Sitios',
        "register-site": 'Registrar Sitio',
        "register-category": 'Registrar Categoría',
        slug: 'Nombre Corto',

        //Propiedades modelos
        document: 'Documento',
        document_type: 'Tipo Documento',
        name: 'Nombre',
        email: 'Email',
        password: 'Contraseña',
        remember_me: 'Recuérdame',
        forgot_your_password: '¿Olvidaste tu contraseña?',
        log_in: 'Ingresar',
        profile: 'Perfil',
        log_out: 'Salir',
        delete_account: 'Eliminar Cuenta',

        profile_information: 'Información de perfil',
        update_profile_information: 'Actualice la información de perfil y la dirección de correo electrónico de su cuenta.',
        list_of_users: 'Listado de Usuarios',
    },
    // Agrega otros idiomas según sea necesario
};

const i18n = createI18n({
    locale: 'es', // idioma por defecto
    messages,
});

export default i18n;
