<template>
	<div class="home">
		<div class="home__feed">
            <!-- Create Post -->
            <div class="post">
                <div class="form__input-group w-12/12">
                    <div class="p-3">
                        <label class="form__label" style="font-size: 17px; margin-bottom: 20px">Write and share something...</label>
                        <br><br>
                        <vue-editor id="sample1" v-model="content"></vue-editor>
                        <div class="form__input-group w-7/12">
                            <label class="form__label">Visibility: </label>
                            <select id="branch" v-model="selectedPostType" name="postype" class="form__input place-self-center">
                                <option selected disabled value="0">-- Select Visibility Type --</option>
                                <option v-for="pt in aPostTypes" v-bind:value="pt.pt_id">
                                    {{ pt.pt_desc }}
                                </option>
                            </select>
                        </div>
                        <div v-if="selectedPostType > 1" >
                            <div class="form__input-group w-7/12">
                                <label class="form__label">Associated Degree: </label>
                                <select id="degree" v-model="selectedDegree" name="degree" class="form__input place-self-center">
                                    <option selected value="0">-- Select Degree --</option>
                                    <option v-for="degree in aDegree" v-bind:value="degree.degree_id">
                                        {{ degree.degree_desc }}
                                    </option>
                                </select>
                            </div>
                            <div v-if="selectedDegree > 0" >
                                <div class="form__input-group w-7/12">
                                    <label class="form__label">Associated Course / Program: </label>
                                    <select id="course" v-model="selectedCourse" name="course" class="form__input place-self-center">
                                        <option selected value="0">-- Select Course / Program --</option>
                                        <option v-for="course in aCourse" v-bind:value="course.course_id">
                                            {{ course.course_desc }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-flow-col auto-cols-max" style="margin-top: 10px">
                            <button type="button" class="form__button w-full" style="margin-right: 20px" @click="clearPostForm">
                                <span style="margin: 5px; font-size: 15px">Clear All</span>&nbsp;
                            </button>&nbsp;&nbsp;
                            <button type="button" class="form__button success w-full" @click="savePost">
                                <span style="margin: 5px; font-size: 15px">Post</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container if post is retrieved -->
            <div v-if="aPostList === ''" style="display: flex; justify-content: center; margin-top: 20px">
                <img src="/img/loading-buffering.gif" style="width: 100px; height: 100px">
            </div>
            <!-- Container for Retrieving Post -->
            <div v-else style="margin-top: 20px">
                <div
                    v-for="post in aPostList"
                    class="post"
                >
                    <div class="post__header">
                        <div class="post__profile">
                            <div class="post__image" v-if="post.acc_picture === null">
                                <font-awesome-icon far icon="user-circle" size="2x" />
                            </div>
                            <img v-if="$root.sRootUserProfPic !== null" :src="post.acc_picture" style="width: 45px; height: 45px; border-radius: 50%; border: 3px solid #6E6E6E" alt="Profile"/>
                            <div class="post__info">
                                <label class="post__name">{{ post.acc_username }}</label>
                                <label class="post__date">{{ post.created_at }}</label>
                            </div>
                        </div>
                        <button class="post__option-toggle">
                            <font-awesome-icon far icon="ellipsis-h" size="lg" />
                        </button>
                    </div>
                    <div class="post__content" style="margin: 0 !important;">
                        <vue-editor v-model="post.post_desc" :editorOptions=editorSettings :disabled="true"></vue-editor>
                    </div>
                    <div class="post__action">
                        <p>
                            <span v-if="post.like_count > 1">{{ post.like_count }} Likes</span>
                            <span v-if="post.like_count <= 1">{{ post.like_count }} Like</span>
                            &nbsp;&nbsp;&nbsp;
                                <button @click="displayComments(post.post_id)" v-if="post.comment_count > 1"><u>{{ post.comment_count }} Comments</u></button>
                            <button @click="displayComments(post.post_id)" v-if="post.comment_count === 1"><u>{{ post.comment_count }} Comment</u></button>
                            <span v-if="post.comment_count === 0"><u>{{ post.comment_count }} Comment</u></span>
                        </p>
                    </div>
                    <div class="post__action">
                        <button
                            :class="['post__action-item', { active: checkLikeStatus(post.post_id) }]"
                        >
						<span :class="['post__action-icon', { active: checkLikeStatus(post.post_id) }]">
							<font-awesome-icon far icon="lightbulb" size="lg"/>
						</span>
                            <label @click="likeUnlike(0, post.post_id)" v-if="checkLikeStatus(post.post_id) === true"
                                   :class="['post__action-label', { active: true }]">Liked</label>
                            <label @click="likeUnlike(1, post.post_id)" v-else :class="['post__action-label', { active: false }]">Like</label>
                        </button>
                        &nbsp;
                        <button class="post__action-item" @click="showCommentEntry(post.post_id)">
                            <span class="post__action-icon">
                                <font-awesome-icon far icon="comment" size="lg"/>
                            </span>
                            <label class="post__action-label">Comment</label>
                        </button>
                    </div>
                    <!-- Display comments -->
                    <div :id="'disp_comments_'+post.post_id" style="display: none">
                        <div class="post__profile" v-for="comment in aComments"
                             style="font-size: 14px !important; background-color: #ececec; border-radius: 10px; margin: 10px;">
                                <div class="post__image" v-if="comment.commenter_pic === null" style="margin: 5px">
                                    <font-awesome-icon far icon="user-circle" size="2x"/>
                                </div>
                                <img v-else :src="comment.commenter_pic"
                                     style="width: 45px; height: 45px; border-radius: 50%; border: 3px solid #6E6E6E; margin: 5px;"
                                     alt="Profile"/>
                                <div class="post__info" style="margin: 5px;">
                                    <label class="post__name">{{ comment.commented_by }}</label>
                                    <label class="post__date">{{ comment.updated_at }}</label>
                                    <p>{{ comment.cm_desc }}</p>
                                </div>
                        </div>
                    </div>
                    <!-- Display comment section -->
                    <div :id="'post_comment_'+post.post_id" class="post__action" style="display: none">
                        <div class="grid grid-flow-col auto-cols-max">
                            <textarea :id="'pt_comment_'+post.post_id" style="width: 520px; border: 1px solid #6e6e6e; border-radius: 5px" placeholder="Write a comment..."></textarea>
                            <button type="button" class="form__button success w-full" style="margin-left: 15px;" @click="saveComment(post.post_id)">
                                <span style="margin: 5px; font-size: 15px">Post</span>
                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="separator"></div>
                <div style="display: flex; justify-content: center;">
                    <p>No More Posts Available</p>
                </div>
                <br>
            </div>
		</div>
	</div>
</template>
<script>
import {VueEditor} from "vue2-editor";
export default {
    components: {
        VueEditor
    },
    watch : {
        selectedDegree (iDegree) {
            if (iDegree > 0) {
                this.getCourse(iDegree);
            }
        }
    },
	data() {
		return {
		    content : '',
            editorSettings: {
                modules: {
                    toolbar: false
                }
            },
			postList: [
				{
					author: "Estelle Bright",
					date: "A few weeks ago",
					stats: {
						likes: 12,
						comment: 123,
						isLiked: false,
					},
					content:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
				},
			],
            aPostTypes       : [],
            aDegree          : [],
            aCourse          : [],
            aAccLikes        : [],
            aComments        : [],
            aPostList        : '',
            selectedPostType : 0,
            selectedDegree   : 0,
            selectedCourse   : 0,
		};
	},
	created() {
		this.$root.sLayout = "default";
		this.$root.setUserInfo();
	},
    mounted () {
      this.getPostType();
      this.getDegree();
      this.getPosts();
    },
    methods: {

        showCommentEntry: function (iPostId) {
            let divId = '#post_comment_' + iPostId;
            $(divId).css('display', '');
        },

        displayComments: function (iPostId) {
            this.$root.getRequest('admin/posts/comments/read', (mResponse) => {
                this.aComments = mResponse.data;
            }, {cm_post_id : iPostId})
            let divId = '#disp_comments_' + iPostId;
            $(divId).css('display', '');
        },

        getPostType: function () {
            this.$root.getRequest('admin/system/post_type/read', (mResponse) => {
                this.aPostTypes = mResponse.data;
            }, {status: 1})
        },

        getDegree: function () {
            this.$root.getRequest('admin/system/degree/read', (mResponse) => {
                this.aDegree = mResponse.data;
            }, {status: 1})
        },

        getCourse: function (iDegree) {
            this.$root.getRequest('admin/system/course/read', (mResponse) => {
                this.aCourse = mResponse.data;
            }, {status: 1, course_degree_id : iDegree})
        },

        getPosts: function () {
            this.$root.getRequest('admin/posts/read', (mResponse) => {
                this.aPostList = mResponse.data;
                this.getLikeStatus();
            });
        },

        getLikeStatus: function () {
            this.$root.getRequest('admin/posts/likes/readAll', (mResponse) => {
                this.aAccLikes = mResponse.data;
            }, {lk_acc_id: this.$root.sRootUserId});
        },

        checkLikeStatus: function (iPostId) {
            let mResult = this.aAccLikes.filter(function(obj) {
                return (obj.lk_post_id === iPostId);
            });
            return mResult.length === 0 ? false : true;
        },

        clearPostForm: function () {
            this.content = '';
            this.selectedPostType = 0;
            this.selectedDegree = 0;
            this.selectedCourse = 0;
        },

        likeUnlike: function (status, iPostId) {
            let oParam = {
                'lk_status' : status,
                'lk_post_id': iPostId,
            };
            this.$root.postRequest('admin/posts/likes/manage', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                   console.log(mResponse.data);
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        savePost: function () {
            let oParam = {
                'post_desc'  : this.content,
                'post_pt_id' : this.selectedPostType,
            };
            oParam = this.selectedDegree == 0 ? oParam : Object.assign(oParam, {'post_degree_id' : this.selectedDegree});
            oParam = this.selectedCourse == 0 ? oParam : Object.assign(oParam, {'post_course_id' : this.selectedCourse});
            this.$root.postRequest('admin/posts/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully posted a new post');
                    this.clearPostForm();
                    this.getPosts();
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        },

        saveComment: function (iPostId) {
            let oParam = {
                'cm_desc'   : $('#pt_comment_' + iPostId).val(),
                'cm_post_id': iPostId,
            };
            this.$root.postRequest('admin/posts/comments/create', oParam, (mResponse) => {
                if (mResponse.code === 200) {
                    this.$root.showSuccessToast('Success', 'Successfully posted your comment');
                    $('#pt_comment_' + iPostId).val('');
                    this.displayComments(iPostId);
                } else {
                    this.$root.showErrorToast('Error', mResponse.message);
                }
            });
        }
    }
};
</script>

<style>
@import "./Home.css";
</style>
