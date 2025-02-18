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
        users: 'Usuarios',
        roles: 'Roles',
        "register-site": 'Registrar Sitio',
        "register-category": 'Registrar Categoría',
        slug: 'Nombre Corto',

        //Propiedades modelos
        document: 'Documento',
        document_type: 'Tipo Documento',
        site_type: 'Tipo de Sitio',
        name: 'Nombre',
        email: 'Email',
        password: 'Contraseña',
        password_confirmation: 'Confirmar Contraseña',
        remember_me: 'Recuérdame',
        forgot_your_password: '¿Olvidaste tu contraseña?',
        log_in: 'Ingresar',
        profile: 'Perfil',
        log_out: 'Salir',
        delete_account: 'Eliminar Cuenta',
        role: 'Rol',
        expires_at: 'Expira el',
        logo: 'Logo',
        url_logo: 'Ruta del logo',
        currency: 'Tipo de Moneda',

        profile_information: 'Información de perfil',
        update_profile_information: 'Actualice la información de perfil y la dirección de correo electrónico de su cuenta.',
        list_of_users: 'Listado de Usuarios',
        register_user: 'Registrar Usuario',

        Admin: 'Administrador',
        Guest: 'Invitado',
        Customer: 'Cliente',

        Invoice: 'Factura',
        Subscription: 'Subscripcin',
        Donation: 'Donación'
    },
    // Agrega otros idiomas según sea necesario
};

const i18n = createI18n({
    locale: 'es', // idioma por defecto
    messages,
});

export default i18n;
