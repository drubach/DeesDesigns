""" Form to add projects. """
from django import forms
from .models import Project


class ProjectForm(forms.ModelForm):
    """ Enter a project form. """
    class Meta:
        """ Instantiate class. """
        model = Project
        fields = ('project_name', 'description', 'type',)
