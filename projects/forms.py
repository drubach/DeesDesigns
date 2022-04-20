""" Form to add projects. """
from django import forms
from django.contrib.auth.models import User
from .models import Type, Project


class ProjectForm(forms.ModelForm):
    """ Enter a project form. """
    class Meta:
        """ Instantiate class. """
        model = Project
        fields = ('project_name', 'description', 'type',)        
