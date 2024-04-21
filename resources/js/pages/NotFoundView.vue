<template>
  <BaseHeader />
  <main class="not-found-content">
    <v-container>
      <div class="not-found">
        <h3 class="not-found-title">
          お探しのページは見つかりませんでした。
        </h3>
        <p class="not-found-description">
          あなたがアクセスしたページは現在表示できません。<br />
          URLが変更されたか削除されたか、<br />
          もしくは現在サーバーに繋がりにくい状態である可能性があります。
        </p>
      </div>
    </v-container>
  </main>
</template>

<style lang="scss" scoped>
@import "../../sass/_mixin.scss";

.v-container {
  padding: 0 !important;
}
.not-found-content {
  background: var(--bs-secondary-bg-subtle);
  margin: 16px 0 0 0;
}
.not-found {
  padding: 80px 0;
  text-align: center;
  .not-found-title {
    margin: 0 0 24px 0;
    font-weight: 700;
    @include sp {
      margin: 0 0 18px 0;
    }
  }
  .not-found-description {
    color: var(--bs-secondary);
  }
}
</style>
