<!--
  Matomo - free/libre analytics platform
  @link https://matomo.org
  @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
-->

<template>
  <div
    :title="translate('Feedback_RateFeatureTitle', $sanitize(title))"
    class="ratefeature"
  >
    <div
      class="iconContainer"
      v-on:mouseenter="expanded = true"
      v-on:mouseleave="expanded = false"
    >
      <img
        v-on:click="likeFeature();showFeedbackForm=true"
        class="like-icon"
        src="plugins/Feedback/vue/src/RateFeature/thumbs-up.png"
      />
      <img
        v-on:click="dislikeFeature();showFeedbackForm=true"
        class="dislike-icon"
        v-show="expanded"
        src="plugins/Feedback/vue/src/RateFeature/thumbs-down.png"
      />
    </div>
    <MatomoDialog
      v-model="showFeedbackForm"
      @yes="sendFeedback()"
    >
      <div
        class="ui-confirm ratefeatureDialog"
      >
        <h2>{{ translate('Feedback_RateFeatureThankYouTitle', title) }}</h2>
        <p v-if="like">{{ translate('Feedback_RateFeatureLeaveMessageLike') }}</p>
        <p v-if="!like">{{ translate('Feedback_RateFeatureLeaveMessageDislike') }}</p>
        <br />
        <div class="messageContainer">
          <textarea v-model="feedbackMessage" />
        </div>
        <input
          type="button"
          :title="translate('Feedback_RateFeatureSendFeedbackInformation')"
          :value="translate('Feedback_SendFeedback')"
          role="yes"
        />
        <input
          type="button"
          role="cancel"
          :value="translate('General_Cancel')"
        />
      </div>
    </MatomoDialog>
    <MatomoDialog
      v-model="ratingDone"
    >
      <div
        class="ui-confirm ratefeatureDialog"
      >
        <h2>{{ translate('Feedback_ThankYou', title) }}</h2>
        <div
          v-if="like"
        >
        </div>
        <input
          type="button"
          :value="translate('General_Ok')"
          role="yes"
        />
      </div>
    </MatomoDialog>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { MatomoDialog, AjaxHelper } from 'CoreHome';

export default defineComponent({
  props: {
    title: String,
  },
  components: {
    MatomoDialog,
  },
  data() {
    return {
      like: false,
      ratingDone: false,
      expanded: false,
      showFeedbackForm: false,
      feedbackMessage: '',
    };
  },
  methods: {
    dislikeFeature() {
      this.like = false;
    },
    likeFeature() {
      this.like = true;
    },
    sendFeedback() {
      AjaxHelper.fetch({
        method: 'Feedback.sendFeedbackForFeature',
        featureName: this.title,
        like: this.like ? '1' : '0',
        message: this.feedbackMessage,
      });
      this.ratingDone = true;
    },
  },
});
</script>
