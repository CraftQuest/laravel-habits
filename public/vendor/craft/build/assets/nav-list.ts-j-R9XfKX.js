import{o as e,t,u as n}from"./lit-CY4PVSWl.js";var r=class extends t{render(){return e`
      <ul class="nav-list">
        <slot></slot>
      </ul>
    `}};r.styles=n`
    :host {
      display: block;
    }

    .nav-list {
      display: grid;
      margin: 0;
      padding: 0;
      list-style: none;
    }
  `,customElements.get(`craft-nav-list`)||customElements.define(`craft-nav-list`,r);export{r as t};