using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RegisseurEnFilm.Domain.Entities
{
    public class Regisseur
    {
        public int Id { get; set; }
        public string Naam { get; set; }
        public ICollection<Film>? Films { get; set; }
    }
}
