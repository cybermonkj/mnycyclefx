<style>
@import url('https://fonts.googleapis.com/css2?family={{$set->default_font}}:wght@300;400;500;700&display=swap');

body
{
    font-family: "{{$set->default_font}}", sans-serif;
}
pre,code,kbd,samp
{
    font-family: "{{$set->default_font}}", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
}
.tooltip
{
    font-family: "{{$set->default_font}}", sans-serif;
}
.popover
{
    font-family: "{{$set->default_font}}", sans-serif;
}
.text-monospace
{
    font-family: "{{$set->default_font}}", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace !important;
}
.btn-group-colors > .btn:before
{
    font-family: "{{$set->default_font}}", sans-serif;
}
.accordion .card-header:after
{
    font: normal normal normal 14px/1 {{$set->default_font}};
}
.has-danger:after
{
    font-family: '{{$set->default_font}}';
}
.fc-icon
{
    font-family: "{{$set->default_font}}", sans-serif;
}
.ql-container
{
    font-family: "{{$set->default_font}}", sans-serif;
}
</style>