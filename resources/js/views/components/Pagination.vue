<template>
  <div class="flex justify-center">
    <nav aria-label="Page navigation example">
      <ul class="flex list-style-none">
        <li class="page-item">
          <a
            @click="onClickFirstPage"
            :disabled="isInFirstPage"
            class="
              page-link
              relative
              block
              py-1.5
              px-3
              rounded
              border-0
              bg-transparent
              outline-none
              transition-all
              duration-300
              rounded
              text-gray-800
              hover:text-gray-800
              focus:shadow-none
            "
            href="#"
            aria-label="First"
          >
            <span aria-hidden="true">FIRST</span>
          </a>
        </li>
        <li class="page-item">
          <a
            @click="onClickPreviousPage"
            :disabled="isInFirstPage"
            class="
              page-link
              relative
              block
              py-1.5
              px-3
              rounded
              border-0
              bg-transparent
              outline-none
              transition-all
              duration-300
              rounded
              text-gray-800
              hover:text-gray-800
              focus:shadow-none
            "
            href="#"
            aria-label="Previous"
          >
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item" v-for="page in pages" :key="page.name">
          <a
            @click="onClickNumbers(page.name)"
            :class="[page.name == currentPage ? 'bg-blue-400' : '']"
            class="
              page-link
              relative
              block
              py-1.5
              px-3
              rounded
              border-0
              bg-transparent
              outline-none
              transition-all
              duration-300
              rounded
              text-gray-800
              hover:text-gray-800 hover:bg-gray-200
              focus:shadow-none
            "
            >{{ page.name }}</a
          >
        </li>
        <li class="page-item">
          <a
            @click="onClickNextPage"
            :disabled="isInLastPage"
            class="
              page-link
              relative
              block
              py-1.5
              px-3
              rounded
              border-0
              bg-transparent
              outline-none
              transition-all
              duration-300
              rounded
              text-gray-800
              hover:text-gray-800 hover:bg-gray-200
              focus:shadow-none
            "
            href="#"
            aria-label="Next"
          >
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <li class="page-item">
          <a
            @click="onClickLastPage"
            :disabled="isInLastPage"
            class="
              page-link
              relative
              block
              py-1.5
              px-3
              rounded
              border-0
              bg-transparent
              outline-none
              transition-all
              duration-300
              rounded
              text-gray-800
              hover:text-gray-800 hover:bg-gray-200
              focus:shadow-none
            "
            href="#"
            aria-label="Last"
          >
            <span aria-hidden="true">LAST</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>

  <script>
export default {
  props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 5,
    },
    totalPages: {
      type: Number,
      required: true,
    },
    perPage: {
      type: Number,
      required: true,
    },
    currentPage: {
      type: Number,
      required: true,
    },
  },

  computed: {
    isInFirstPage() {
      return this.currentPage === 1;
    },
    isInLastPage() {
      return this.currentPage === this.totalPages;
    },
    startPage() {
      // When on the first page
      if (this.currentPage === 1) {
        return 1;
      }

      // When on the last page
      if (this.currentPage === this.totalPages) {
        return this.totalPages - this.maxVisibleButtons;
      }

      // When inbetween
      return this.currentPage - 1;
    },
    pages() {
      const range = [];

      for (
        let i = this.startPage;
        i <=
        Math.min(this.startPage + this.maxVisibleButtons, this.totalPages);
        i++
      ) {
        if (i >= 1 && i<= this.totalPages) {
          range.push({
            name: i,
            isDisabled: i === this.currentPage,
          });
        }
      }

      return range;
    },
  },

  methods: {
    onClickNumbers(page) {
      if (this.currentPage) {
        this.$emit("pagechanged", page);
      }
    },
    onClickFirstPage() {
      this.$emit("pagechanged", 1);
    },
    onClickPreviousPage() {
      if (this.currentPage > 1) {
        this.$emit("pagechanged", this.currentPage - 1);
      }
    },
    onClickPage(page) {
      this.$emit("pagechanged", page);
    },
    onClickNextPage() {
      if (this.totalPages >= this.currentPage + 1) {
        this.$emit("pagechanged", this.currentPage + 1);
      }
    },
    onClickLastPage() {
      this.$emit("pagechanged", this.totalPages);
    },

    isPageActive(page) {
      return this.currentPage === page;
    },
  },
};
</script>
