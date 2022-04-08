***REMOVED*** Tag products with their types***REMOVED***
from django import template
from projects.models import Type

register = template.Library()

@register.filter(name='types')
def types(all_types):
    ***REMOVED*** Function to get list of types. ***REMOVED***
    all_types = Type.objects.values()
    return all_types
