/**
 * @author TheCelavi
 * @license http://www.runopencode.com/terms-and-conditions/free-for-all Free for all
 * @category Diem Front behaviors
 * @version 1.0.0
 */
;
(function($) {

    var methods = {
        init: function(behavior) {
            var $this = $(this),
            data = $this.data('dmSyntaxHighlighterBehavior');
            if (data && behavior.dm_behavior_id != data.dm_behavior_id) {
                alert('You can not attach tooltip behavior to same content');
            };
            $this.data('dmSyntaxHighlighterBehavior', behavior);
        },
        start: function(behavior) {
            var $this = $(this);
            // Highlighter does not have a good destroy method :(
            // This is memory mess, so it would be convinient to have view behavior and admin behavior
            var $copy = $this.children().clone(true, true);
            $this.data('dmSyntaxHighlighterBehaviorPreviousDOM', $this.children().detach());
            $this.children().remove();
            $this.append($copy);

            var $pre = $this.find('pre');
            $.each($pre, function(){
                var $elem = $(this),
                $sh = $('<pre></pre>');
                if ($elem.find('code')) {
                    $sh.html($elem.find('code').html());
                } else {
                    $sh.html($elem.html());
                };
                $elem.replaceWith($sh);
                var scriptClass = 'brush: ' + behavior.brush;
                scriptClass += '; gutter: ' + behavior.gutter;
                scriptClass += '; auto-links: ' + behavior.auto_links;
                scriptClass += '; collapse: ' + behavior.collapse;
                scriptClass += '; first-line: ' + behavior.first_line;
                scriptClass += '; highlight: ' + behavior.highlight;
                scriptClass += '; html-script: ' + behavior.html_script;
                scriptClass += '; smart-tabs: ' + behavior.smart_tabs;
                scriptClass += '; tab-size: ' + behavior.tab_size;
                scriptClass += '; toolbar: ' + behavior.toolbar;
                scriptClass += ';';
                $sh.prop('class', scriptClass);
            });
            SyntaxHighlighter.highlight();
        },
        stop: function(behavior) {
            var $this = $(this);
            $this.children().remove();
            $this.append($this.data('dmSyntaxHighlighterBehaviorPreviousDOM'));
        },
        destroy: function(behavior) {
            var $this = $(this);
            $this.data('dmSyntaxHighlighterBehavior', null);
            $this.data('dmSyntaxHighlighterBehaviorPreviousDOM', null);
        }
    };

    $.fn.dmSyntaxHighlighterBehavior = function(method, behavior){

        return this.each(function() {
            if ( methods[method] ) {
                return methods[ method ].apply( this, [behavior]);
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, [method] );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.dmSyntaxHighlighterBehavior' );
            };
        });
    };

    $.extend($.dm.behaviors, {
        dmSyntaxHighlighterBehavior: {
            init: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmSyntaxHighlighterBehavior('init', behavior);
            },
            start: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmSyntaxHighlighterBehavior('start', behavior);
            },
            stop: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmSyntaxHighlighterBehavior('stop', behavior);
            },
            destroy: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior) + ' ' + behavior.inner_target).dmSyntaxHighlighterBehavior('destroy', behavior);
            }
        }
    });

})(jQuery);