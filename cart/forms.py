""" Form to add projects. """
from django import forms
from django.conf import settings
# from matplotlib import widgets
from projects.models import Project, Type
class ProjectForm(forms.ModelForm):
    """ Enter a project form. """
    class Meta:
        """ Instantiate class. """
        model = Project
        fields = ('project_name', 'description', 'type')
        widgets = {
            'type':forms.Select(attrs={'onchange':"getPrice(this.value);"})
        }
