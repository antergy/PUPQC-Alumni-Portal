<template>
    <div class="home">
        <Navigation/>
        <div class="home__wrapper">
            <div class="home__panel--left">
                <ul class="home__list">
                    <div class="profile">
                        <div class="profile__image">
                            <font-awesome-icon far icon="user-circle" size="2x"/>
                        </div>
                        <div class="profile__container">
                            <label class="profile__label">{{ this.$root.sRootFullname }}</label>
                            <label class="profile__position">{{ this.$root.sRootAccPos }}</label>
                        </div>
                    </div>
                    <label class="home__list-title">Navigation Title</label>
                    <li class="home__list-item">
                        Navigation 01
                    </li>
                    <li class="home__list-item">
                        Navigation 02
                    </li>
                    <li class="home__list-item">
                        Navigation 03
                    </li>
                </ul>
                <ul class="home__list">
                    <label class="home__list-title">Navigation Title</label>
                    <li class="home__list-item">
                        Navigation 04
                    </li>
                    <li class="home__list-item">
                        Navigation 05
                    </li>
                    <li class="home__list-item">
                        Navigation 06
                    </li>
                    <li class="home__list-item">
                        Navigation 07
                    </li>
                </ul>
            </div>
            <div class="home__panel--center">
                <div class="feed">
                    <div
                        v-for="(oPost, iPostKey) in postList"
                        :key="`post${iPostKey}`"
                        class="post"
                    >
                        <div class="post__header">
                            <div class="post__profile">
                                <div class="post__image">
                                    <font-awesome-icon far icon="user-circle" size="2x"/>
                                </div>
                                <div class="post__info">
                                    <label class="post__name">{{ oPost.author }}</label>
                                    <label class="post__date">{{ oPost.date }}</label>
                                </div>
                            </div>
                            <button class="post__option-toggle">
                                <font-awesome-icon far icon="ellipsis-h" size="lg"/>
                            </button>
                        </div>
                        <div class="post__content">
                            <label> {{ oPost.content }} </label>
                        </div>
                        <div class="post__action">
                            <button :class="['post__action-item', { active: oPost.stats.isLiked }]">
                                <font-awesome-icon far icon="lightbulb" size="lg"/>
                                <label class="post__action-label">{{
                                        oPost.stats.isLiked ? 'You liked this' : 'Like'
                                    }}</label>
                            </button>
                            <button class="post__action-item">
                                <font-awesome-icon far icon="comment" size="lg"/>
                                <label class="post__action-label">Comment</label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home__panel--right">
                <ul class="home__list">
                    <label class="home__list-title">Navigation Title</label>
                    <li class="home__list-item">
                        Navigation 08
                    </li>
                    <li class="home__list-item">
                        Navigation 09
                    </li>
                    <li class="home__list-item">
                        Navigation 10
                    </li>
                    <li class="home__list-item">
                        Navigation 11
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            postList: [
                {
                    author: 'Estelle Bright',
                    date: 'A few weeks ago',
                    stats: {
                        likes: 12,
                        comment: 123,
                        isLiked: false
                    },
                    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },
                {
                    author: 'Rean Schwarzer',
                    date: '2 days ago',
                    stats: {
                        likes: 124,
                        comment: 11,
                        isLiked: true
                    },
                    content: 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },
                {
                    author: 'Alisa Reinford',
                    date: '3 days ago',
                    stats: {
                        likes: 13,
                        comment: 41,
                        isLiked: false
                    },
                    content: 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },
                {
                    author: 'Tio Plato',
                    date: '1 day ago',
                    stats: {
                        likes: 112,
                        comment: 41,
                        isLiked: true
                    },
                    content: 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },
                {
                    author: 'Tita Rusell',
                    date: '1 day ago',
                    stats: {
                        likes: 112,
                        comment: 41,
                        isLiked: true
                    },
                    content: 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },

                {
                    author: 'Renne Bright',
                    date: '10 day ago',
                    stats: {
                        likes: 52,
                        comment: 41,
                        isLiked: false
                    },
                    content: 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                },
            ]
        }
    },
    created() {
        this.$root.setUserInfo();
    },
}
</script>

<style scoped>
@import './Home.css';
</style>
