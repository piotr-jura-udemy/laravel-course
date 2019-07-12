<template>
  <div>
    <div>
      User name: {{ name }}
      User id: {{ id }}
      Is user enabled: {{ isEnabled }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["name", "id", "isEnabled"],
  mounted: function() {
    console.log(typeof this.name);
    console.log(this.name);
    console.log(typeof this.isEnabled);
    console.log(this.isEnabled);
    console.log(typeof this.id);
    console.log(this.id);
  }
};
</script>
