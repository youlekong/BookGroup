
let Vue =  require('vue');
let VueRouter = require('vue-router');

const backend = require('./api/backend.js');

Vue.use(VueRouter);

const main = require('./views/main.vue').default;
const login = require('./views/login.vue').default;

// children
const index = require('./views/index.vue').default;
const user = require('./views/user.vue').default;
const book = require('./views/book/book.vue').default;
const bookCate = require('./views/book/bookCate.vue').default;
const bookComment = require('./views/book/bookComment.vue').default;
const article = require('./views/article/article.vue').default;
const articleComment = require('./views/article/articleComment.vue').default;
const group = require('./views/group/group.vue').default;
const groupCate = require('./views/group/groupCate.vue').default;
const activity = require('./views/activity.vue').default;
const rental = require('./views/rental.vue').default;
const share = require('./views/share.vue').default;

const children = [
    {   name: 'index', path: 'index', component: index },
    {   name: 'user', path: 'user', component: user },
    {   name: 'book', path: 'book', component: book },
    {   name: 'bookCate', path: 'bookCate', component: bookCate },
    {   name: 'bookComment', path: 'bookComment', component: bookComment },
    {   name: 'article', path: 'article', component: article },
    {   name: 'articleComment', path: 'articleComment', component: articleComment },
    {   name: 'group', path: 'group', component: group },
    {   name: 'groupCate', path: 'groupCate', component: groupCate },
    {   name: 'activity', path: 'activity', component: activity },
    {   name: 'rental', path: 'rental', component: rental   },
    {   name: 'share', path: 'share', component: share   },
    {   path: '/', redirect: 'index' }
];

const routes = [
    {   name: 'login', path: '/login', component: login  },
    {   path: '/main', component: main, children: children    },
    {   path: '/', redirect: 'login' }
];

const router = new VueRouter({
    routes
});

router.beforeEach( (to, from, next) => {

    if (to.name === 'login') {
        backend.apiCheckStatus().then(res => {
            if (res.msg.status) {
                next({name: 'index'});
                return
            }

            next();
        }).catch(err => {
            next({name: 'login'});
        })
    } else {
        next();
    }
    
});

module.exports = router;