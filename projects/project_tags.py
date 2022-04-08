""" Tag products with their types"""
from django import template
from projects.models import Type

register = template.Library()

@register.filter(name='types')
def types(all_types):
    """ Function to get list of types. """
    all_types = Type.objects.values()
    return all_types
