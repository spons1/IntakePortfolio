using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RegisseurEnFilm.Domain.Entities
{
    public class Film
    {
        public int Id { get; set; }
        public string Titel { get; set; }
        public DateTime Publicatiedatum { get; set; }
        public int RegisseurID { get; set; }

        public virtual Regisseur? Regisseur { get; set; }
    }
}
