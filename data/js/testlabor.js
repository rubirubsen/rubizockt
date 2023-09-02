javascript:
    setTimeout( () => {
        var cat_cloner = skin.findElements('category_cloner')[0];
        if (cat_cloner) {
            var openTag = player.getVariableValue('open_tag');
            var element;
            for (var i = 0; i < cat_cloner.ggInstances.length; i ++) {
                if (cat_cloner.ggInstances[i].ggTag == openTag) {
                    element = cat_cloner.ggInstances[i]._category;
                    break;
                }
            }
            var scrollOffX = element.offsetLeft;
            var scrollOffY = element.offsetTop;
            var domRect = element.getBoundingClientRect();
            var parentEl = element.parentElement;
            while (parentEl) {
                if (parentEl.ggScrollIntoView) {
                    parentEl.ggScrollIntoView(scrollOffX, scrollOffY, domRect.width, domRect.height);
                    break;
                }
                scrollOffX += parentEl.offsetLeft;
                scrollOffY += parentEl.offsetTop;
                parentEl = parentEl.parentElement;
            }
        }
    }, 1010);

hier soll er ein slideup(300) und ein slidedown(300)  für das "cat_cloner"-Element einfügen, wenn es gefunden wurde.