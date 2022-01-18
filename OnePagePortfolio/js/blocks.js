/*
====================================
    Gutenburg Blocks
====================================
*/



wp.blocks.registerBlockType("portfolio/border-box", {
    title: "My Cool border box",
    icon: "smiley",
    category: "common",
    attributes: {
        content: {type: 'sting'},
        color: {type: 'string'}
    },
    edit: function(props){
        function updateContent(event){
            props.setAttributes({content: event.target.value});
        }

        function updateColor(value){
            props.setAttributes({color: value.hex});
        }

        return React.createElement("div", null, /*#__PURE__*/React.createElement("h4", null, "Your Cool Border Box"), /*#__PURE__*/React.createElement("input", {
            type: "text",
            onChange: updateContent,
            value: props.attributes.content
          }), /*#__PURE__*/React.createElement(wp.components.ColorPicker, {
            onChangeComplete: updateColor,
            color: props.attributes.color
          }));
    },
    save: function(props) {
        return React.createElement("h3", {
            style: {
              border: `5px solid ${props.attributes.color}`
            }
          }, props.attributes.content);
    }
});

/*
====================================
    Icon Card
====================================
*/

wp.blocks.registerBlockType("portfolio/icon-card", {
    title: "Icon Card",
    icon: "feedback",
    category: "common",
    attributes: {
        icon: {type: "string"},
        title: {type: 'sting'},
        content: {type: 'string'}
    },
    edit: function(props){
        function updateIcon(event){
            props.setAttributes({icon: event.target.value});
        }
        function updateTitle(event){
            props.setAttributes({title: event.target.value});
        }
        function updateContent(event){
            props.setAttributes({content: event.target.value});
        }

        return wp.element.createElement("div", {
            class: "icon-card-editor"
          }, wp.element.createElement("input", {
            class: "icon",
            type: "text",
            placeholder: "icon",
            value: props.attributes.icon,
            onChange: updateIcon
          }), wp.element.createElement("input", {
            class: "title",
            type: "text",
            placeholder: "title",
            onChange: updateTitle,
            value: props.attributes.title
          }), wp.element.createElement("input", {
            class: "content",
            type: "text",
            placeholder: "content",
            onChange: updateContent,
            value: props.attributes.content
          }));
    },
    save: function(props){
        const { RawHTML } = wp.element;
        return wp.element.createElement("div", null, wp.element.createElement("div", {
            class: "icon-card"
          }, wp.element.createElement(RawHTML, {
            class: "icon"
          }, props.attributes.icon), wp.element.createElement("p", {
            class: "title"
          }, props.attributes.title), wp.element.createElement("p", {
            class: "content"
          }, props.attributes.content)));
    }
});

/*
====================================
    Progress Circle
====================================
*/

wp.blocks.registerBlockType("portfolio/progress-circle",{
    title: 'Progress Circle',
    icon: "marker",
    category: "common",
    attributes: {
        textColor: {type: 'string'},
        hoverColor: {type: 'string'},
        ringColor: {type: 'string'},
        percent: {type: 'number'},
        content: {type: 'string'}
    },
    edit: function(props){
        function updateContent(event){
            props.setAttributes({content: event.target.value});
        }
        function updatePercent(event){
            props.setAttributes({percent: event.target.value});
        }
        function updateRingtColor(value){
            props.setAttributes({ringColor: value.hex});
        }

        return wp.element.createElement("div", {
          class: "progress-circle-editor"
        },wp.element.createElement("input", {
          type: "text",
          value: props.attributes.content,
          placeholder: "Text",
          onChange: updateContent
        }), wp.element.createElement("input", {
          type: "text",
          value: props.attributes.percent,
          placeholder: "Percent",
          onChange: updatePercent
        }),wp.element.createElement("p", null, "Ring Color"), wp.element.createElement(wp.components.ColorPicker, {
          color: props.attributes.ringColor,
          onChangeComplete: updateRingtColor
        }));
    },
    save: function(props){
        return wp.element.createElement("div", null, wp.element.createElement("div", {
            class: "circle-container"
          }, wp.element.createElement("div", {
            class: "box"
          }, wp.element.createElement("div", {
            class: "percent"
          }, wp.element.createElement("svg", null, wp.element.createElement("circle", {
            cx: "70",
            cy: "70",
            r: "70"
          }), wp.element.createElement("circle", {
            cx: "70",
            cy: "70",
            r: "70",
            style: {
              "--tooltip-ring": props.attributes.ringColor,
              "--tooltip-percent": props.attributes.percent
            }
          })), wp.element.createElement("div", {
            class: "number"
          }, wp.element.createElement("h2", null, props.attributes.percent, wp.element.createElement("span", null, "%")))), wp.element.createElement("h2", {
            class: "text"
          }, props.attributes.content))));
    }
});