using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    public class HostConfiguration
    {
        public int ID { get; set; }
        public int Rooms { get; set; }
        public int Beds { get; set; }
        public int Bathrooms { get; set; }
        public virtual ICollection<Equipment>? Equipments { get; set; }
    }
}
