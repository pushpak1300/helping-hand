<template>
  <footer class="footer px-4">
    <div class="row align-items-center justify-content-lg-end">
      <div class="col-lg-6">
        <div class="copyright text-center text-lg-left text-muted">
          © {{year}} <a href="https://www.google.com" class="font-weight-bold ml-1" target="_blank">TeamTricode</a>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      year: new Date().getFullYear()
    };
  }
};
</script>
<style></style>
