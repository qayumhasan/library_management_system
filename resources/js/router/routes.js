import MainComponent from '@/views/layouts/MainComponent.vue'
import HomeComponent from '@/views/home/index.vue'
import AuthorComponent from '@/views/authors/index.vue'
import BookComponent from '@/views/books/index.vue'
import MemberComponent from '@/views/members/index.vue'
import BorrowdBookComponent from '@/views/borrowdBooks/index.vue'
import LoginComponent from '@/views/auth/login.vue'
import UserComponent from '@/views/users/index.vue'
import RolesComponent from '@/views/roles/index.vue'
import NotFoundComponent from '@/views/errors/NotFoundPage.vue'
import UnauthorizedComponent from '@/views/errors/Unauthorized.vue'


export default [
    {
        path: '/',
        component: MainComponent,
        name:'main',
        children: [
            { path: '/', component: HomeComponent, name: 'home', meta: { requiresAuth: true,role:'home' },},
            { path: '/authors', component: AuthorComponent, name: 'authors', meta: { requiresAuth: true,role:'author-all'} },
            { path: '/books', component: BookComponent, name: 'books', meta: { requiresAuth: true,role:'author-all'},},
            { path: '/members', component: MemberComponent, name: 'members',meta: { requiresAuth: true,role:'author-all' }, },
            { path: '/borrowd-books', component: BorrowdBookComponent, name: 'borrowd_books', meta: { requiresAuth: true },},
            { path: '/users', component: UserComponent, name: 'users', meta: { requiresAuth: true,role:'author-all'},},
            { path: '/roles', component: RolesComponent, name: 'roles', meta: { requiresAuth: true,role:'author-all'},},
            {
                path:'/:pathMatch(.*)*',
                component: NotFoundComponent
            },
            {
                path:'/:pathMatch(.*)*',
                component: UnauthorizedComponent,
                name:'unauthorized'

            }
        ]
    },
    { path: '/login', component: LoginComponent, name: 'login', meta: { requiresAuth: false,role:'guest'}},
];


