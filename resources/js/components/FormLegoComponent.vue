<template>
  <div class="container">
    <form onsubmit="{onSubmit}">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="name"
          name="name"
          onchange="{onChange}"
          value="{form.name}"
        />
      </div>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="description"
          name="description"
          onchange="{onChange}"
          value="{form.description}"
        />
      </div>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="url"
          name="url"
          onchange="{onChange}"
          value="{form.url}"
        />
      </div>
      <div class="form-row">
        <div class="col">
          <input
            type="text"
            class="form-control"
            placeholder="type"
            name="type"
            onchange="{onChange}"
            value="{form.type}"
          />
        </div>
        <div class="col">
          <input
            type="text"
            class="form-control"
            placeholder="rightColor"
            name="rightColor"
            onchange="{onChange}"
            value="{form.rightColor}"
          />
        </div>
      </div>

      <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
  </div>
</template>
<script>
export default {};
</script>
