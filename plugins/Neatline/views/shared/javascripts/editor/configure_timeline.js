/*
     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
*/
(function(b){b.widget("neatline.configuretimeline",{_create:function(){this.content=b("#configure-timeline");this.bandActive=this.content.find('input[name="band-active"]');this.bandUnit=this.content.find('select[name="band-unit"]');this.bandHeight=this.content.find('input[name="band-height"]');this.saveButton=this.content.find("button.save");this._constructDropdown();this._constructFormWidgets()},_constructDropdown:function(){this.element.nlDropdown()},_constructFormWidgets:function(){this.bandHeight.integerdragger({min:0,
max:100,px_per_unit:2});this.saveButton.bind({mousedown:_.bind(function(){this.postSettings()},this),click:function(a){a.preventDefault()}})},_getData:function(){var a={};a.exhibit_id=Neatline.record.id;a.is_context_band=this.bandActive.is(":checked")?1:0;a.context_band_unit=this.bandUnit.val();a.context_band_height=parseInt(this.bandHeight.val(),10);return a},postSettings:function(){var a=this,c=this._getData();b.ajax({url:"ajax/timelinesettings",type:"POST",data:c,success:function(){a._trigger("newdefaults",
{},c)}})},getAttr:function(a){return this[a]}})})(jQuery);
