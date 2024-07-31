import {ClipboardCheck, LayoutDashboard, Settings2, SquareUserRound, UserRoundCog, UsersRound} from "lucide-vue-next";
import {FunctionalComponent} from "vue";

interface IDashboardMenus {
    title: string
    icon: FunctionalComponent,
    path: string
    description?: string
    hidden?: boolean
}

export const SIDEBAR_EXPAND_WIDTH = 280;
export const SIDEBAR_COLLAPSED_WIDTH = 72;
export const APP_MENU: Record<string, { name: string, routes: IDashboardMenus[] }> = {
    main: {
        name: 'Core',
        routes: [
            {
                title: 'Dashboard',
                icon: LayoutDashboard,
                path: '/dashboard',
            },
            {
                title: 'Tenants',
                icon: UsersRound,
                path: '/tenants',
            },
            {
                title: 'Landlords',
                icon: SquareUserRound,
                path: '/landlords',
            },
            {
                title: 'Contractors',
                icon: UserRoundCog,
                path: '/contractors',
            },
            {
                title: 'Tasks',
                icon: ClipboardCheck,
                path: '/task',
                description: 'Manage Tasks'
            },
        ],
    },
    settings: {
        name: 'General',
        routes: [
            {
                path: '/user',
                title: 'User',
                icon: UsersRound,
                description: 'Manage User'
            },
            {
                path: '/settings',
                title: 'Settings',
                icon: Settings2,
                description: 'Settings'
            },
        ],
    },
};

export const globalSearch = {};
